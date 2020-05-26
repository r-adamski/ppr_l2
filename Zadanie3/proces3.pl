#!/usr/bin/perl
 
use strict;
use warnings;
 
use IO::Socket::INET;
 
$| = 1;
 
my ($socket,$data);
 
$socket = new IO::Socket::INET (
    LocalPort => 12346,
    Proto        => 'udp'
) or die "ERROR creating socket : $!\n";
 
my ($datagram,$flags);
while (1) {
    $socket->recv($datagram,42,$flags);
    print "$datagram\n";
}
 
$socket->close();
