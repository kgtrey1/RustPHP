<?php
    class Rcon
    {
        private $server_ip;
        private $rcon_port;
        private $rcon_password;
        private $stream;
        private $authorized;
        private $verbose = false;

        const SERVERDATA_EXECCMD = 2;
        const SERVERDATA_EXECCMD_RESPONSE = 4;
        const SERVERDATA_AUTH = 3;
        const SERVERDATA_AUTH_RESPONSE = 2;
        const SERVERDATA_RESPONSE_VALUE = 0;

        public function __construct($server_ip, $rcon_port, $rcon_password)
        {
            $this->server_ip = $server_ip;
            $this->rcon_port = $rcon_port;
            $this->rcon_password = $rcon_password;
            $this->stream = NULL;
            $this->authorized = FALSE;
        }

        public function disconnect()
        {
            fclose($this->stream);
        }

        public function read($packet_id)
        {
            $notif_size = fread($this->stream, 4);
            $notif_size = unpack('V', $notif_size);
            $notif_id = unpack('V', fread($this->stream, 4));
            $notif_type = unpack('V', fread($this->stream, 4));
            $notif_body = fread($this->stream, $notif_size[1] - 8);
            $response_size = fread($this->stream, 4);
            $response_size = unpack('V', $response_size);
            $response_id = unpack('V', fread($this->stream, 4));
            $response_type = unpack('V', fread($this->stream, 4));
            $response_body = fread($this->stream, $response_size[1] - 8);
            if ($this->verbose)
            {
                echo("<br>PACKET ID = " . $packet_id . "<br>NOTIF SIZE = ". $notif_size[1] . "<br>NOTIF ID = " . $notif_id[1] . 
                     "<br>NOTIF TYPE = " . $notif_type[1] . "<br>NOTIF BODY = " . $notif_body );
                echo("<br>RESP SIZE = ". $response_size[1] . "<br>RESP ID = " . $response_id[1] . 
                     "<br>RESP TYPE = " . $response_type[1] . "<br>RESP BODY = " . $response_body );
            }
            return $response_body;
        }

        public function send($command)
        {
            if ($this->authorized)
            {
                
                $packet_id = rand(1, 100000);
                $request = pack('VV', $packet_id, self::SERVERDATA_EXECCMD) . $command . "\x00\x00";
                $request = pack('V', strlen($request)) . $request;
                $result = fwrite($this->stream, $request);
                return $packet_id;
            }
        }

        public function connect()
        {
            $error = 0;
            $errorstr = "";

            $this->stream = @fsockopen($this->server_ip, intval($this->rcon_port), $error, $errorstring, 1);
            if ($error != 0 || $errorstr != "" || $this->stream == NULL)
                return (-42);
            if ($this->authorize() == 0)
            {
                $this->authorized = true;
                return (0);
            }
            else
            {
                Echo "ERROR WHILE CONNECTING";
            }
        }

        private function authorize()
        {
            $packet_id = rand(1, 100000);
            $request = pack('VV', $packet_id, self::SERVERDATA_AUTH) . $this->rcon_password . "\x00\x00";
            $request = pack('V', strlen($request)) . $request;
            if (strlen($request) != fwrite($this->stream, $request))
                return -21;
            $notif_size = fread($this->stream, 4);
            if ($notif_size == NULL)
                return -2;
            $notif_size = unpack('V', $notif_size);
            if ($notif_size[1] < 10) 
                return -3;
            $notif_id = unpack('V', fread($this->stream, 4));
            if ((int)$notif_id[1] != $packet_id)
                return -4;
            $notif_type = unpack('V', fread($this->stream, 4));
            if ((int)$notif_type[1] != self::SERVERDATA_RESPONSE_VALUE)
                return -5;
            $notif_body = fread($this->stream, $notif_size[1] - 8);
            if ($notif_body != "\x00\x00")
                return -6;
            $resp_size = fread($this->stream, 4);
            if ($resp_size == NULL)
                return -7;
            $resp_size = unpack('V', $resp_size);
            if ($resp_size[1] < 10)
                return -8;
            $resp_id = unpack('V', fread($this->stream, 4));
            if ((int)$resp_id[1] != $packet_id)
                return -9;
            $resp_type = unpack('V', fread($this->stream, 4));
            if ((int)$resp_type[1] != self::SERVERDATA_AUTH_RESPONSE)
                return -10;
            $resp_body = fread($this->stream, $resp_size[1] - 8);
            if ($resp_body != "\x00\x00")
                return -11;
            return 0;
        }
    }
?>