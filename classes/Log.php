<?php
class Log {
    public function error($type, $error) {
        $type = strtoupper($type);
        
        switch ($type) {
            case 'DB':
                $error = $error->getFile().'('.$error->getLine().')'.' ==>'.$error->getMessage();
                break;
        }
        file_put_contents('logs/error.log',  date('F j Y h:i:s A') . ' - ' . $type . ' - ' . $error . "\n", FILE_APPEND);
    }
}