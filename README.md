Symfony Test
========================
# Installation manual (Windows)

* Add in your `C:\Users\<Your_User>\Homestead.yaml` next block:
```yaml
- map: smf.dev
      to: /home/vagrant/www/smf/web
      type: symfony
```
* Comment in your `Vagrantfile` next strings (optional, if don't want remove engin):
```bash
# PMA
	#config.vm.provision :shell, path: "projects/pma.sh"

	# Projects
	#config.vm.provision :shell, path: "projects/engin.sh"
```
* Run `vagrant reload --provision`
* Run `vagrant ssh`
* Run `cd www`
* Run `git clone git@github.com:ourgarage/smf.git`
* Run `cd smf`
* Run `composer install`
* Installation complete!