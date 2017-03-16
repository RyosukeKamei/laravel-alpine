        /*
         * 以前いただいたCipherUtil.csを参考にしています。
         * 復号化できないプログラム
         * 理由：暗号化された文字列から位置ベクトルが取得できない
         * 【前提】openssl_decryptを利用
         * mcrypt_decrypt()は非推奨
         */

        /*
         * 暗号化されたメッセージ
         * 【確認】これはhex（16進数）ですよね？
         * 復号化する際の引数にはバイナリ形式にする必要があるがどのタイミングで行うか？
         */
        $encrypt_message = 'd9ec3a2c9c492da55b3bcb17d005d64a3fdeeca9917e85907ceda5b6bf0908a1290aaacaa0dce8c9e2fde0e7e05fb8b96cdc08eaf5ee2dca0a21c0d9a278ab56b57b03c2b4a2845aa3cc696fa9f29e12fe79cde95c56502b2e5502309f71ec88666a35e37a672988f367b50b9941df8d1716ea7e287c57b439cbef8f5d79c84ea667e463afeeaf5008cccef050dbd0dacc40499a30ff5978e90a1c3bbc3ce65ebe51d3e01fa81e481979e8b0c2bba7e4d36afc0eeb69ab49eda05876ad3ba40d724aac48017c0856d0c4d187c4efee8ad3b9fbc8ba58ed7ce8f5d70a3f1d824fa292ca9d5b6404f71d469fe889df99a97b03796cc15e0b6c5518cb2a9495b59f';

        /*
         * キーはUTF-8でエンコーディング
         * 【確認】キーのエンコーディングは必要か
         */
        $key             = 'L88から始まるもらったキー';

        /*
         * 方式
         * AES 256ビット
         * CBC
         * 【確認】AES 128 or AES 256 どちらでしょうか？
         */
        $method  = 'AES-128-CBC'; // AES-128-CBC でも結果が同じ

        /*
         * 位置ベクトルのサイズはAES CBCの場合16
         */
        $iv_size = openssl_cipher_iv_length($method) * 2;

        echo("位置ベクトルサイズ : ".$iv_size."<br>");

        /*
         * 位置ベクトルを取得
         * バイナリ化してから位置ベクトルを抽出
         */
        $iv = substr($encrypt_message, 0, $iv_size);

        echo("位置ベクトル : ".$iv.'<br>');

        /*
         * 復号化
         */
        $decrypt_message = openssl_decrypt(
              hex2bin(substr($encrypt_message, $iv_size)) // バイナリ化
            , $method
            , $key
            , false
           , hex2bin($iv)
        );

        /*
         * 復号化できない
         */
        echo("復号化した文字列 : ".$decrypt_message);