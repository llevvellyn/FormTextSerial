<?php 
  
  define('EMONCMS_EXEC', 1);

  

  $fsize = filesize ('share.txt');
  echo "File size: ";
  echo ($fsize);
  echo "\n";

  if ( 1 == filesize ('share.txt'))
  {
    echo "File is empty\n";
  }

  
  // Create a stream context that configures the serial port
  // And enables canonical input.
  $c = stream_context_create(array('dio' =>
    array('data_rate' => 9600,
          'data_bits' => 8,
          'stop_bits' => 1,
          'parity' => 0,
          'flow_control' => 0,
          'is_canonical' => 1)));

  echo "Config of serial complete\n";

  // Are we POSIX or Windows?  POSIX platforms do not have a
  // Standard port naming scheme so it could be /dev/ttyUSB0
  // or some long /dev/tty.serial_port_name_thingy on OSX.
  if (PATH_SEPARATOR != ";") {
    $filename = "dio.serial:///dev/ttyAMA0";
    echo "///dev/ttyAMA0\n";
  } else {
    $filename = "dio.serial://dev/ttyAMA0";
    echo "//dev/ttyAMA0\n";
  }

  // Open the stream for read and write and use it.
  $f = fopen($filename, "r+", false, $c); //$f becomes pointer for stream
  //stream_set_timeout($f, 0,1000);

  while(true)
  {
    if ($f)
    {
      echo "Serial stream opened\n";
      if (  '' != file_get_contents ('share.txt'))
      {
        //fprintf($f,$hour.",00,".$min.",00,s");
        //fprintf($f,"$inputfile,s");
        //echo ("$inputfile,s");
        //echo "\n";
        //usleep(100);

        $inputfile = file_get_contents ('share.txt');
  echo "Input file: ";
	echo ($inputfile);
	echo "\n";      

        fprintf($f,"00,$inputfile,00,00,s");
	
        echo "Serial sent\n";
        //sleep (3);

        file_put_contents ('share.txt', "");
        echo "File contents erased\n";
        sleep (4);
      }
    }

    echo "Finished\n";
  }

?>
