HOST="wordwideweb.co"
HOST_USER="wordwide"
HOST_PATH="10x.agency/html/games/epic-title-generator"

echo
echo REMOTE SYNCHRONIZE FILES:
rsync -rv --exclude '.git' . $HOST_USER@$HOST:$HOST_PATH

echo
echo REMOTE SET FILE PERMISSIONS:

ssh $HOST_USER@$HOST bash -c "'

cd $HOST_PATH

find * -type d -print0 | xargs -0 chmod -v 0755 # for directories
find . -type f -print0 | xargs -0 chmod -v 0644 # for files

'"

echo
echo "app is now visible at http://10x.agency/games/epic-title-generator/"
echo