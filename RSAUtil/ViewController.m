//
//  ViewController.m
//  RSAUtil
//
//  Created by ideawu on 7/14/15.
//  Copyright (c) 2015 ideawu. All rights reserved.
//

#import "ViewController.h"
#import "RSA.h"

@interface ViewController ()

@end

@implementation ViewController

- (void)viewDidLoad {
	[super viewDidLoad];


	NSString *pubkey = @"-----BEGIN PUBLIC KEY-----\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDEChqe80lJLTTkJD3X3Lyd7Fj+\nzuOhDZkjuLNPog3YR20e5JcrdqI9IFzNbACY/GQVhbnbvBqYgyql8DfPCGXpn0+X\nNSxELIUw9Vh32QuhGNr3/TBpechrVeVpFPLwyaYNEk1CawgHCeQqf5uaqiaoBDOT\nqeox88Lc1ld7MsfggQIDAQAB\n-----END PUBLIC KEY-----";
	NSString *privkey = @"-----BEGIN RSA PRIVATE KEY-----\nMIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAMQKGp7zSUktNOQk\nPdfcvJ3sWP7O46ENmSO4s0+iDdhHbR7klyt2oj0gXM1sAJj8ZBWFudu8GpiDKqXw\nN88IZemfT5c1LEQshTD1WHfZC6EY2vf9MGl5yGtV5WkU8vDJpg0STUJrCAcJ5Cp/\nm5qqJqgEM5Op6jHzwtzWV3syx+CBAgMBAAECgYEApSzqPzE3d3uqi+tpXB71oY5J\ncfB55PIjLPDrzFX7mlacP6JVKN7dVemVp9OvMTe/UE8LSXRVaFlkLsqXC07FJjhu\nwFXHPdnUf5sanLLdnzt3Mc8vMgUamGJl+er0wdzxM1kPTh0Tmq+DSlu5TlopAHd5\nIqF3DYiORIen3xIwp0ECQQDj6GFaXWzWAu5oUq6j1msTRV3mRZnx8Amxt1ssYM0+\nJLf6QYmpkGFqiQOhHkMgVUwRFqJC8A9EVR1eqabcBXbpAkEA3DQfLVr94vsIWL6+\nVrFcPJW9Xk28CNY6Xnvkin815o2Q0JUHIIIod1eVKCiYDUzZAYAsW0gefJ49sJ4Y\niRJN2QJAKuxeQX2s/NWKfz1rRNIiUnvTBoZ/SvCxcrYcxsvoe9bAi7KCMdxObJkn\nhNXFQLav39wKbV73ESCSqnx7P58L2QJABmhR2+0A5EDvvj1WpokkqPKmfv7+ELfD\nHQq33LvU4q+N3jPn8C85ZDedNHzx57kru1pyb/mKQZANNX10M1DgCQJBAMKn0lEx\nQH2GrkjeWgGVpPZkp0YC+ztNjaUMJmY5g0INUlDgqTWFNftxe8ROvt7JtUvlgtKC\nXdXQrKaEnpebeUQ=\n-----END RSA PRIVATE KEY-----";

	NSString *originString = @"hello world!";
	for(int i=0; i<4; i++){
		originString = [originString stringByAppendingFormat:@" %@", originString];
	}
	NSString *encWithPubKey;
	NSString *decWithPrivKey;
	NSString *encWithPrivKey;
	NSString *decWithPublicKey;
	
	NSLog(@"Original string(%d): %@", (int)originString.length, originString);
	
	// Demo: encrypt with public key
	encWithPubKey = [RSA encryptString:originString publicKey:pubkey];
	NSLog(@"Enctypted with public key: %@", encWithPubKey);
	// Demo: decrypt with private key
	decWithPrivKey = [RSA decryptString:encWithPubKey privateKey:privkey];
	NSLog(@"Decrypted with private key: %@", decWithPrivKey);
	
	// by PHP
	encWithPubKey = @"t/vmUiPKYnGI84GCwo2dUiFSlK+j0L5Dpo2uColFpraxUyT+3mdpt/JWRzNVzRfYAhtJNsuo3+W5ZaNrLf+nkWVa6TMUA5QsQzYDQbgjmfLEy+yIq8YOS0O3JdE+jeZwdM8+B+cRujVMAe0sWHkvCqqi3ZnMLVbzc/98Vr22lCB4Xs3MCtthq82YCfifZY+uABcb3pwr2d/nbmHeXT2Y/jjGPsIB+9yfcxISjIr66OL4lX3C6Rfqp+n709kWDNNEHl0jGV31QBSv8ezIo3pKLUZdpZMYRc1ZjPWcp/JK3DEejOqVwGRJR7u1twrFJu2V1Szw9PC3tGVyC54aUEvz3Q==";
	decWithPrivKey = [RSA decryptString:encWithPubKey privateKey:privkey];
	NSLog(@"(PHP enc)Decrypted with private key: %@", decWithPrivKey);
	
	// Demo: encrypt with private key
	// TODO: encryption with private key currently NOT WORKING YET!
	//encWithPrivKey = [RSA encryptString:originString privateKey:privkey];
	//NSLog(@"Enctypted with private key: %@", encWithPrivKey);

	// Demo: decrypt with public key
	encWithPrivKey = @"JYkX0BI8pPN5PTALIw68h6nr85IlV3xuwXgQrn4YPmADjnUtBdTc+vZDldkWObRQOO/0OII4BVrB2nvAEDFg2+3WsNVpOqLOBxpUmks4VcGo0+NKDssroaE5/Ympn7mjZvmGjafdS47Kx/L6PDEEznFiirPxpShgPu2zCwtww8BJOazZWUuXbylj8/YkLq8Vc3SQDTW/Z0SjZIjSfod5z63TPtgUepUMNZ+3dX4qPuv9CuVKbqPPYUJqPMRXg7zUbA1l3vTc7w1xaL7KAKTNZMUxG++Z3MO4xh68DPRE7xoxrYH7V+v+cmbDSr4FOphY7gcUqBuHJz6NRiulAtlT8A==";
	decWithPublicKey = [RSA decryptString:encWithPrivKey publicKey:pubkey];
	NSLog(@"(PHP enc)Decrypted with public key: %@", decWithPublicKey);
}

@end
