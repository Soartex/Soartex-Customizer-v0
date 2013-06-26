<div class="header"> 
  <!-- Logo --> 
  <img src="<?php if(isset($url_add)) echo $url_add;?>assets/img/logo.png" alt="Soartex Fanver Forums"> 
  <!-- Nav Bar -->
  <nav class="navbar navbar-static-top">
    <div class="navbar-inner"> <a class="brand" href="http://soartex.net/"> <img src="<?php if(isset($url_add)) echo $url_add;?>assets/img/soar32.png"> Soartex</a> 
      <!--Menu List-->
      <ul class="nav">
        <li> <a href="http://soartex.net/"><i class="icon-home"></i> Home </a> </li>
        <li> <a href="http://soartex.net/forum/"><i class="icon-pencil"></i> Forums </a> </li>
        <li> <a href="http://soartex.net/downloads/"><i class="icon-download"></i> Downloads </a> </li>
        <li> <a href="http://customizer.soartex.net/"><i class = "icon-list"></i> Customizer</a> </li>
        <li> <a href="http://files.soartex.net/"><i class="icon-file"></i> File Server </a> </li>
        <!--List for tools/extra stuff-->
        <li class="dropdown closed"> <a class="dropdown-toggle" data-toggle="dropdown" ><i class="icon-wrench"></i> Tools <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li> <a href="http://soartex.net/texture-patcher/"><i class = "icon-cog"></i> Texture-Patcher</a> </li>
            <li> <a href="https://github.com/Soartex-Fanver/"><i class = "icon-globe"></i> Our Github</a> </li>
            <li> <a href="http://files.soartex.net/zip-manager/"><i class = "icon-hdd"></i> Zip Manager</a> </li>
            <li> <a href="http://soartex.net/tools/"><i class = "icon-info-sign"></i> About Our Tools</a> </li>
          </ul>
        </li>
      </ul>
      <!-- User Login -->
      <ul class="nav pull-right">
        <li class="dropdown closed"> <a class="dropdown-toggle" data-toggle="dropdown" id="1"><i class="icon-user"></i><b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li> <a href="">Sign In</a> </li>
            <li> <a href="">Register</a> </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</div>
<!-- End of Header -->