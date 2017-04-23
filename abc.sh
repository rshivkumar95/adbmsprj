for thefile in *.html ; do
   grep -v "text to remove" $thefile > $thefile.$$.tmp
   mv $thefile.$$.tmp $thefile
done
