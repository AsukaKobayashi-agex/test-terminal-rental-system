�� �܂��͂��߂�

�ȉ��̃A�v���P�[�V�������C���X�g�[������i���j
�EGit Bash
�EVirtualBox
�EchefDK
�EVagrant

�� 64Bit��Windows10�Ɋ��\�z���s�����Ƃ�O��Ƃ���

	�� Git Bash
		https://gitforwindows.org/

	�� VirtualBox
		setup\win_install_app\
			VirtualBox-5.1.30-118389-Win.exe

	�� chefDK
		setup\win_install_app\
			chefdk-1.2.22-1-x86.msi

	�� Vagrant
		setup\win_install_app\
			vagrant_2.0.1_x86_64.msi


�����ȍ~�̊��\�z��Ƃ���ۂ�Bash���Ǘ��Ҍ����ŋN������


�� Vagrant �������O��

	�� �v���O�C�����C���X�g�[��
		�� �v���O�C���C���X�g�[��
			VagrantFile �̂���f�B���N�g���isatup/vm�j�Ŏ��s
			$ vagrant plugin install vagrant-omnibus

	�� Vagrant������}�E���g����f�B���N�g��

		\setup
			\vm
				Vagrantfile

		�� ��L/setup/vm�t�@���_���A���z�����/vagrant�ɂ�����


�� Vagrant�N��

	$ vagrant up
	$ vagrant reload --provision

	�� vagrant up�ňȉ��̃G���[�����������ꍇ�A
	�@ BIOS�̐ݒ�ŁA���z���@�\��L���ɂ���

		Security -> Virtualization

	[�G���[���e]
		VBoxManage.exe: error: VT-x is not available (VERR_VMX_NO_VMX)
		VBoxManage.exe: error: Details: code E_FAIL (0x80004005), component ConsoleWrap, interface IConsole


�� ���[�J�����Z�b�g�A�b�v

	/rental_system/.env.example ���R�s�[���āA
	/rental_system/.env.local �Ƀ��l�[������

	���z���ɃA�N�Z�X���Acomposer install�����s

	$ vagrant ssh (���z���Ƀ��O�C��)

	$ cd /var/www/rental_system
	$ composer install


�� �u���E�U����A�N�Z�X

	�Ǘ��Ҍ����Ń��������J���Ahosts�t�@�C����ҏW����
	C:\Windows\System32\drivers\etc\hosts

==
# �e�X�g�[���ݏo�V�X�e��
192.168.33.10	vm.rental-system
==

	�u���E�U����ȉ��ɃA�N�Z�X
	https://vm.rental-system/

	�y�[�W���\�����ꂽ��OK
	�� �f�t�H���g�y�[�W�uLaravel�v�̕������\�������


�� ���[�J���ŊJ������Ƃ��ɒ���I�ɍs������

	�Z .env.local�t�@�C���̍X�V

		.env.example�t�@�C�����X�V���ꂽ�ꍇ�A
		�蓮��.env.local�t�@�C���֍X�V���e�𔽉f����B

		�� .env.local�t�@�C���̓R�~�b�g���Ȃ�����

	�Z composer install

		src\site\composer.json �t�@�C�����X�V���ꂽ�ۂ́A
		composer install�����s����B

		$ cd /var/www/rental_system
		$ composer install


�� �������グ���ɍ���������

	�Z �������킹

		$ sudo yum install ntp
		$ sudo ntpdate ntp.nict.jp

	�� Application Key�̐ݒ�

		RuntimeException No application encryption key has been specified.
		�̃G���[������������A�ȉ������s

		$ cd /var/www/rental_system
		$ php artisan key:generate


�� �������グ��ɔ��������g���u�����

	�� Windows Update ��ɁAVagrant up ���G���[�Ȃ� (2018-08-02)

		Windows Update ��ɁAVagrant�������オ��Ȃ��Ȃ�ꍇ������悤�ł��B
		�l�X�Ȍ���������܂����A��̓I�ȃP�[�X�̈�Ƃ��āA�ȉ����L�ڂ��Ă����܂��B

		�� �R�}���h�v�����v�g�̃G���[���e�F�iVagrant up��ɁA���̓��e�ŃG���[�ɂȂ�j

		(�O��)
		Command: ["hostonlyif", "create"]
		Stderr: 0%...
		Progress state: E_FAIL
		VBoxManage.exe: error: Failed to create the host-only adapter
		(�㗪)

		�� �������Ă��錻�ہF

		�R���g���[���p�l�� �� �l�b�g���[�N�ƃC���^�[�l�b�g �� �l�b�g���[�N�̐ڑ� ���J���āA
		�A�_�v�^�[�̐ݒ�̕ύX ���J���ƁA�{����������Ă���͂��� host-only adapter �����݂��Ȃ�

		�� ��������ł������@�F

		�ȉ��̋L���̓��e�ɉ����đΉ�������������܂����B

		vagrant up �� �uFailed to create the host-only adapter�v�����������ꍇ�̑Ή�
		http://blog.officekoma.co.jp/2018/04/vagrant-up-failed-to-create-host-only.html

		�E�C���X�o�X�^�[����肾�����悤�ł��B
		�Ȃ��A�L���ł�VirtualBox�̃A���C���X�g�[�����K�v�Ƃ���Ă��܂����A
		�A���C���X�g�[�����Ȃ��ŁA�A�b�v�f�[�g�����ŉ����ł��܂����B


	�� �����X�V



�ȏ�
