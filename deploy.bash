HOST="epictitlegenerator.com"
HOST_USER="root"
HOST_PATH="/var/www/epictitlegenerator.com/public_html/"
WEBSERVER_DIR="title-images"
APP_URL="http://EpicTitleGenerator.com"

echo
echo REMOTE SYNCHRONIZE FILES:
rsync -rv --exclude '.git' . $HOST_USER@$HOST:$HOST_PATH

echo
echo REMOTE SET FILE PERMISSIONS:

ssh $HOST_USER@$HOST bash -c "'

cd $HOST_PATH

find * -type d -print0 | xargs -0 chmod -v 0755 # for directories
find . -type f -print0 | xargs -0 chmod -v 0644 # for files

find $WEBSERVER_DIR -type d -print0 | xargs -0 chmod -v 0777 # for directories
find $WEBSERVER_DIR -type f -print0 | xargs -0 chmod -v 0666 # for files

chmod 0777 $WEBSERVER_DIR

'"

echo
echo "app is now visible at $APP_URL"
echo