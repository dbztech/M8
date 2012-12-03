<?php 
$headerstuff = NULL;
$pageTitle = "MPA Robotics - Twitter Feed";
include('header.php');
?>

<div id="content">
<div class="contentblock" style="height: 450px; background: #111; padding: 5px;">
<div id="twittercontainer">
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<div style="float:left;">
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 18,
  interval: 6000,
  width: 300,
  height: 360,
  theme: {
    shell: {
      background: '#666666',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#0196e1'
    }
  },
  features: {
    scrollbar: true,
    loop: false,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    behavior: 'all'
  }
}).render().setUser('MPARobotics').start();
</script>
</div>
<div style="float:right;">
<script>
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: 'first robotics',
  interval: 6000,
  title: 'From across the Internet',
  subject: 'Recent FIRST Tweets',
  width: 300,
  height: 360,
  theme: {
    shell: {
      background: '#666666',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#0196e1'
    }
  },
  features: {
    scrollbar: false,
    loop: true,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    toptweets: true,
    behavior: 'default'
  }
}).render().start();
</script>
</div>
</div>
</div>
<br />
</div>


<?php 
$footerstuff = NULL;
include('footer.php');
?>
