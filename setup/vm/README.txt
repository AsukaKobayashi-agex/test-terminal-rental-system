◆ まずはじめに

以下のアプリケーションをインストールする（※）
・Git Bash
・VirtualBox
・chefDK
・Vagrant

※ 64Bit版Windows10に環境構築を行うことを前提とする

	○ Git Bash
		https://gitforwindows.org/

	○ VirtualBox
		setup\win_install_app\
			VirtualBox-5.1.30-118389-Win.exe

	○ chefDK
		setup\win_install_app\
			chefdk-1.2.22-1-x86.msi

	○ Vagrant
		setup\win_install_app\
			vagrant_2.0.1_x86_64.msi


次項以降の環境構築作業する際はBashを管理者権限で起動する


◆ Vagrant 動かす前に

	○ プラグインをインストール
		□ プラグインインストール
			VagrantFile のあるディレクトリ（satup/vm）で実行
			$ vagrant plugin install vagrant-omnibus

	○ Vagrant環境からマウントするディレクトリ

		\setup
			\vm
				Vagrantfile

		※ 上記/setup/vmファルダが、仮想環境上の/vagrantにあたる


◆ Vagrant起動

	$ vagrant up
	$ vagrant reload --provision

	※ vagrant upで以下のエラーが発生した場合、
	　 BIOSの設定で、仮想化機能を有効にする

		Security -> Virtualization

	[エラー内容]
		VBoxManage.exe: error: VT-x is not available (VERR_VMX_NO_VMX)
		VBoxManage.exe: error: Details: code E_FAIL (0x80004005), component ConsoleWrap, interface IConsole


◆ ローカル環境セットアップ

	/rental_system/.env.example をコピーして、
	/rental_system/.env.local にリネームする

	仮想環境にアクセスし、composer installを実行

	$ vagrant ssh (仮想環境にログイン)

	$ cd /var/www/rental_system
	$ composer install


◆ ブラウザからアクセス

	管理者権限でメモ帳を開き、hostsファイルを編集する
	C:\Windows\System32\drivers\etc\hosts

==
# テスト端末貸出システム
192.168.33.10	vm.rental-system
==

	ブラウザから以下にアクセス
	https://vm.rental-system/

	ページが表示されたらOK
	※ デフォルトページ「Laravel」の文字が表示される


◆ ローカルで開発するときに定期的に行うこと

	〇 .env.localファイルの更新

		.env.exampleファイルが更新された場合、
		手動で.env.localファイルへ更新内容を反映する。

		※ .env.localファイルはコミットしないこと

	〇 composer install

		src\site\composer.json ファイルが更新された際は、
		composer installを実行する。

		$ cd /var/www/rental_system
		$ composer install


◆ 環境立ち上げ時に困ったこと

	〇 時刻合わせ

		$ sudo yum install ntp
		$ sudo ntpdate ntp.nict.jp

	○ Application Keyの設定

		RuntimeException No application encryption key has been specified.
		のエラーが発生したら、以下を実行

		$ cd /var/www/rental_system
		$ php artisan key:generate


◆ 環境立ち上げ後に発生したトラブル情報

	◎ Windows Update 後に、Vagrant up がエラーなる (2018-08-02)

		Windows Update 後に、Vagrantが立ち上がらなくなる場合があるようです。
		様々な原因がありますが、具体的なケースの一つとして、以下を記載しておきます。

		▼ コマンドプロンプトのエラー内容：（Vagrant up後に、この内容でエラーになる）

		(前略)
		Command: ["hostonlyif", "create"]
		Stderr: 0%...
		Progress state: E_FAIL
		VBoxManage.exe: error: Failed to create the host-only adapter
		(後略)

		▼ 発生している現象：

		コントロールパネル ＞ ネットワークとインターネット ＞ ネットワークの接続 を開いて、
		アダプターの設定の変更 を開くと、本来生成されているはずの host-only adapter が存在しない

		▼ 今回解決できた方法：

		以下の記事の内容に沿って対応したら解決しました。

		vagrant up で 「Failed to create the host-only adapter」が発生した場合の対応
		http://blog.officekoma.co.jp/2018/04/vagrant-up-failed-to-create-host-only.html

		ウイルスバスターが問題だったようです。
		なお、記事ではVirtualBoxのアンインストールが必要とされていますが、
		アンインストールしないで、アップデートだけで解決できました。


	※ 随時更新



以上
