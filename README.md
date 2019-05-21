# 目的

CSV ダウンロード機能を実装する上で、ファイルサイズが大きくなればなるほど
通常メモリの消費が大きくなってくる

どれだけファイルサイズが大きくなっても、メモリの問題を回避して実装する方法を検証するためのスクリプトを作ってみた

# 前提

vagrant, virtualbox がインストールされている環境であること

# vagrant 起動方法

```
git clone https://github.com/oz-urabe/qiita-for-csv-download.git
cd qiita-for-csv-download
vagrant up --provision
```

# 動作確認方法

ブラウザで http://10.0.0.10 にアクセス

- 取り急ぎ実装したバージョン
    - 該当ソースコード: src/csv-download.php
- メモリリミットが起きないように回避したバージョン
    - 該当ソースコード: src/csv-download-tuned.php

# License

These codes are licensed under CC0.

[![CC0](http://i.creativecommons.org/p/zero/1.0/88x31.png "CC0")](http://creativecommons.org/publicdomain/zero/1.0/deed.ja)
