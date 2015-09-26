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

	NSData *data;

	// Demo: encrypt with public key
	NSString *encWithPubKey = [RSA encryptString:@"hello world!" publicKey:pubkey];
	NSLog(@"Enctypted with public key: %@", encWithPubKey);

	// Demo: decrypt with private key
	data = [[NSData alloc] initWithBase64EncodedString:encWithPubKey options:NSDataBase64DecodingIgnoreUnknownCharacters];
	data = [RSA decryptData:data privateKey:privkey];
	NSString *decWithPrivKey = [[NSString alloc] initWithData:data encoding:NSUTF8StringEncoding];
	NSLog(@"Decrypted with private key: %@", decWithPrivKey);


	// Demo: encrypt with private key
	// TODO: encryption with private key currently NOT WORKING YET!
	NSString *encWithPrivKey = [RSA encryptString:@"hello world!" privateKey:privkey];
	NSLog(@"Enctypted with private key: %@", encWithPrivKey);

	// Demo: decrypt with public key
	// encWithPrivKey: a string encrypted by the private key
	encWithPrivKey = @"F+feHOH6807tUV/drvepAMzKlVKRsoDFRkFNfhS9kgVoBt2E6OnUIVw12l608yQGWiqtq8rgZgMY/VCQYZB+3r2rhDlyZ2fjo00sUFOp5BkNPFTs/NpQAolD6V3ifNgDmBQP92uVbxbod1pLRwLC0wLOhr5flQXvvobeg5KrDeE=";
	data = [[NSData alloc] initWithBase64EncodedString:encWithPrivKey options:NSDataBase64DecodingIgnoreUnknownCharacters];
	data = [RSA decryptData:data publicKey:pubkey];
	NSString *decWithPublicKey = [[NSString alloc] initWithData:data encoding:NSUTF8StringEncoding];
	NSLog(@"Decrypted with public key: %@", decWithPublicKey);
}

@end
