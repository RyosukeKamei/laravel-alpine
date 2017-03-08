<?php
        /*
         * SSO連携での暗号化複合化について認識合わせをしたいので
         * 気になる箇所をコメントで書いています。
         * こちらでも暗号化・複合化する際のサンプルソースを書きました。
         */
        
        /*
         * 暗号化対象文字列
         */
        $plaintext = 'plain';

        /*
         * STN様からいただいたキー（セキュリティを考慮して仮キー）
         */
        $key = 'from_STN_key';

        /*
         * エンコーディング方法
         */
        $method = 'aes-256-cbc';

        /*
         * SSO時に初期化ベクトル（$iv）ってどのように合わせるのですか？
         * 【参考】
         * http://yut.hatenablog.com/entry/20120205/1328375985
         * 
         * 下記は仮のやり方
         * PHP関数 openssl_random_pseudo_bytes()で疑似乱数のバイト文字列を生成する
         * 長さはopenssl_cipher_iv_length('aes-256-cbc')で、aes-256-cbcの適切な長さ
         */
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));

        /*
         * ハッシュ
         * ChipherUtil.csのCreateHashをみるとSHA1？のようですが、セキュリティ上まずくないですか？
         * 御社はJavaを使っていると認識しています。
         * JavaとPHPでセキュアなハッシュ値をやりとりするのであればHMACでSHA256で行うのはいかがでしょうか
         * 
         * 【参考】JAVAとPHPでSHA256のハッシュ値を比較している
         * http://kaworu.jpn.org/java/Java%E3%81%A7HMAC-SHA256%E3%82%92%E8%A8%88%E7%AE%97%E3%81%99%E3%82%8B
         */
        echo "SHA256：" . hash_hmac(
                                'sha256'
                              , $plaintext
                              , true /* 第3引数 trueはバイト falseは16進数 */
                          );

        /*
         * openssl_encryptはデフォルトPKCS#7 パディングするらしい
         * （openssl_encryptのPKCS#7 パディングはJavaのPKCS#5 パディングらしい）
         * 特に引数で指定はしない
         * 
         * 【参考】
         * http://blog.shin1x1.com/entry/openssl-add-pkcs7-padding
         */
        $encrypted = openssl_encrypt($plaintext, $method, $key, 0, $iv);
        echo("encrypted: ".$encrypted);

        $decrypted = openssl_decrypt($encrypted, $method, $key, 0, $iv);
        echo("decrypted: ".$decrypted);
        /*
         * end of 暗号化・複合化
         */
?>