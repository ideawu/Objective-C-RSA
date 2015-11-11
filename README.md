# Objective-C-RSA
Doing RSA encryption with Objective-C iOS

## If you have the same qustion as mine: [iOS Objective-C RSA encrypt with only public key and descrypt with PHP](http://www.ideawu.com/blog/post/132.html)

## History

### 2015-09-26

- New functions:
  - `(NSString *)decryptString:(NSString *)str privateKey:(NSString *)privKey;`
  - `(NSData *)decryptData:(NSData *)data privateKey:(NSString *)privKey;`

## Usage

```
#import "RSA.h"
	
NSString *pubkey = @"-----BEGIN PUBLIC KEY-----\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDLuwt30JLYFvKcFOUdjPuDRdqv\nSnDb5TSdA/w0ND/GwLExpT66DeRz9+6//G//Y0y3c/yWT14k/ab1vID4U6W3vOgr\nafC0RyuIgH8ooCTNQpU+LtIoZ6qCejnux7VZ5lwWeT/9DQjWOtf6TopeRdzmOX09\nwa7c5xGGUsmi29QxDQIDAQAB\n-----END PUBLIC KEY-----";
NSString *ret = [RSA encryptString:@"hello world!" publicKey:pubkey];
NSLog(@"encrypted: %@", ret);
```

## The PHP script for testing

See `encrypt.php` in the repository.


## Swift version

- [https://github.com/btnguyen2k/swift-rsautils](https://github.com/btnguyen2k/swift-rsautils)

