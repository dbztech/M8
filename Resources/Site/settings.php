<?php
#This is the basic M8 personalized settings file
foreach (glob("Widgets/*.php") as $filename)
{
    include $filename;
}
foreach (glob("Plugins/*.php") as $filename)
{
    include $filename;
}
echo "Personalized Settings Initialized <br />";
?>