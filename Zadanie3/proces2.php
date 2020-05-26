#!/usr/bin/php

<?php

	$host = "127.0.0.1";
	$port = 12345;
	
	if( ! ( $server = socket_create( AF_INET, SOCK_STREAM, SOL_TCP ) ) ){
		print "socket_create(): " 		. socket_strerror( socket_last_error( $server ) ) . "\n";
		exit( 1 );
	}
	
	if( ! socket_set_option($server, SOL_SOCKET, SO_REUSEADDR, 1) ) {
		print "socket_set_option(): " 	. socket_strerror(socket_last_error( $server ) ) . "\n";
		exit( 1 );
	}
	
	if( ! socket_bind( $server, $host, $port ) ){
		print "socket_bind(): " 		. socket_strerror( socket_last_error( $server ) ) . "\n";
		exit( 1 );
	}
	
	if( ! socket_listen( $server, 5 ) ){
		print "socket_listen(): " 		. socket_strerror( socket_last_error( $server ) ) . "\n";
		exit( 1 );
	}
	
	while( $client = socket_accept( $server ) ){
    
       $msg = ""; 
        while( $rcv = socket_read( $client, 256 ) ){ 
            $msg .= $rcv;  
        }
    
		
		#print "$msg\n";
		
		
		$hex = bin2hex($msg);
		
		# print "$hex\n";
		
		
		$host1 = "127.0.0.1";
	$port1 = 12346;
	
	if( ! ( $client1 = socket_create( AF_INET, SOCK_DGRAM, SOL_UDP ) ) ){
		print "socket_create(): " 	. socket_strerror( socket_last_error( $client1 ) ) . "\n";
		exit( 1 );
	}
	
	if( ! socket_connect( $client1, $host1, $port1 ) ){
		print "socket_connect(): " 	. socket_strerror( socket_last_error( $client1 ) ) . "\n";
		exit( 1 );
	}
		
        socket_write( $client1, $hex, strlen($hex));
        
        socket_close($client1);
		
		socket_close( $client );
	}
	
	
	socket_close( $server );
?>
