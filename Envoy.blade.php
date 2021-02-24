@servers(['web' => '52.78.139.237'])

@task('deploy')
    cd /var/www/price
    sudo git pull origin master
    sudo composer install
@endtask
