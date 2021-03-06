<?php
require_once("require/rgame.php");
require_once("require/secure.php");

$first = "";
$last = "";

if ( !Unsecure() )
{
    $first = First();
    $last = Last();
}
/*if ( Type() != "NONE" )
{
    $team = Team();
    echo "<div class='navbar-header'><a class='navbar-brand' href='#'>$first $last, $team</a></div>";
}
else
{
    echo "<div class='navbar-header'><a class='navbar-brand' href='#'>$first $last</a></div>";
}*/
//echo "<div class='navbar-header col-xs-2 col-sm-2 col-md-2'>";
echo "<div class='navbar-header'>";
echo "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>";
echo "<span class='sr-only'>Toggle navigation</span>";
echo "<span class='icon-bar'></span>";
echo "<span class='icon-bar'></span>";
echo "<span class='icon-bar'></span>";
echo "</button>";
//echo "<h4 class='navbar-brand' style='margin-top: 15px; height: 25px; padding: 0; '>Humans vs Zombies</h4>";
echo "<a class='navbar-brand' style='color: white'>Humans vs Zombies</a>";
echo "</div>";
echo "<div style='max-height: 540px' class='navbar-collapse collapse'>";
echo "<ul class='nav navbar-nav navbar-right'>";
echo "<li class='test'><a href='panel.php'>Home</a></li>";
global $rules_file;
global $map_file;
echo "<li class='test'><a href=\"mods.php\">Contact Moderators</a></li>";
echo "<li class='test'><a href='$rules_file'>Game Rules</a></li>";
echo "<li class='test'><a href='$map_file'>Game Map</a></li>";
echo "<li class='test'><a href=\"graphs.php\">Graph</a></li>";
if ( Unsecure() )
{
    echo "<li class='test'><a href=\"password.php\">Forgot/Reset Password</a></li>";
    echo "<li class='test'><a href='login.php'>Login</a></li>";
}
elseif ( IsPlayer() )
{
    echo "<li class='test'><a href=\"players2.php\">Player List</a></li>";
    if ( is_game_started() )
    {

        echo "<li class='test'><a href='mission_briefing.php'>Mission Briefing</a></li>";
        echo "<li class='test'><a href='tag.php'>Report Killing a Human</a></li>";
        if (IsHuman())
        {
            echo "<li class='test'><a href='stun.php'>Report Stunning a Zombie</a></li>";
            echo "<li class='test'><a href='supply.php'>Cash in Supply Code</a></li>";
        }
    }
    if ( IsZombie() )
    {
        echo "<li class='test'><a href='ztree.php'>Zombie Family Tree</a></li>";
    }
    echo "<li class='test'><a href=\"password.php\">Change Password</a></li>";
    echo "<li class='test'><a href='breakdown.php'>Score Breakdown</a></li>";
}
else if ( IsAdmin() )
{
    echo "<li class='test'><a href=\"players2.php\">Player List</a></li>";
    echo "<li class='test'><a href=\"add_player.php\">Add Player</a></li>";
    echo "<li class='test'><a href=\"schedule_briefing.php\">Schedule Briefing</a></li>";
    echo "<li class='test'><a href=\"signup_locations.php\">Sign Up Locations</a></li>";
    echo "<li class='test'><a href=\"oz2.php\">Manage OZ List</a></li>";
    echo "<li class='test'><a href=\"startgame.php\">Start Game Wizard</a></li>";
    echo "<li class='test'><a href=\"game.php\">Game Settings</a></li>";
    echo "<li class='test'><a href=\"manage_inventory.php\">Inventory Management</a></li>";
    echo "<li class='test'><a href=\"subscriptions.php\">Mailing Lists</a></li>";
    echo "<li class='test'><a href=\"manage_stuns.php\">Stun Management</a></li>";
    echo "<li class='test'><a href=\"milestones.php\">View Milestone Report</a></li>";
    echo "<li class='test'><a href=\"manage_supply.php\">Generate Supply Codes</a></li>";
    echo "<li class='test'><a href=\"view_mail.php\">View Mail Logs</a></li>";
    echo "<li class='test'><a href=\"edit_template.php\">Edit E-Mail Templates</a></li>";
    echo "<li class='test'><a href=\"manage_waiver.php\">Waiver Information</a></li>";
    echo "<li class='test'><a href=\"archive.php\">Archive Management</a></li>";
    echo "<li class='test'><a href=\"csv.php\">CSV</a></li>";
}

if ( !Unsecure() && (IsPlayer() || IsAdmin()) )
{
    $imp = GetImpersonate();
    if ($imp != NULL)
    {
        echo "<li class='test'><a href='panel.php?imp_end='>End Impersonation</a></li>";
        echo "<li><a style='color: red' href='#'>IMPERSONATING $first $last</a></li>";
    }
    else
    {
        echo "<li class='test'><a href='login.php?logout='>Logout</a></li>";
        echo "<li><a style='color: white' href='#'>$first $last</a></li>";
    }
}
?>
<script>
    $("button.navbar-toggle").click( function () {
        $('div.navbar-collapse').collapse('toggle');
    });
</script>
<?php
echo "</ul>";

echo "<ul class='nav navbar-nav'>";
if( !is_game_started() )
{

    echo "<li><a style='color: white'>Game will start on " . date('l F jS \a\t g:iA', strtotime(get_game_start())) . "</a></li>";
    //echo "<p>Game will start on " . date('l F jS \a\t g:iA', strtotime(get_game_start())) . "</p>";
}

/*$imp = GetImpersonate();
if( $imp != NULL )
{
	//echo "<p><strong style='color:red'>YOU ARE CURRENTLY IMPERSONATING A USER. TO RETURN TO BEING AN ADMIN, CLICK <a href='panel.php?imp_end='>HERE</a></strong></p>";
    echo "<li style='margin-top: 15px; height: 25px; padding: 0; color: red'><a style='padding: 0; display: inline' href='panel.php?imp_end='>END IMPERSONATION</li>";
}*/
echo "</ul></div>";
?>
