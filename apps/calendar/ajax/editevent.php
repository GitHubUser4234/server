<?php
/*************************************************
 * ownCloud - Calendar Plugin                     *
 *                                                *
 * (c) Copyright 2011 Bart Visscher               *
 * License: GNU AFFERO GENERAL PUBLIC LICENSE     *
 *                                                *
 * <http://www.gnu.org/licenses/>                 *
 * If you are not able to view the License,       *
 * <http://www.gnu.org/licenses/>                 *
 * please write to the Free Software Foundation.  *
 * Address:                                       *
 * 59 Temple Place, Suite 330, Boston,            *
 * MA 02111-1307  USA                             *
 *************************************************/
require_once('../../../lib/base.php');

$l10n = new OC_L10N('calendar');

if(!OC_USER::isLoggedIn()) {
	die('<script type="text/javascript">document.location = oc_webroot;</script>');
}

$errarr = OC_Calendar_Object::validateRequest($_POST);
if($errarr){
	//show validate errors
	$errarr["error"] = "true";
	echo json_encode($errarr);
	exit;
}else{
	$id = $_POST['id'];
	$data = OC_Calendar_Object::find($id);
	if (!$data)
	{
		echo json_encode(array("error"=>"true"));
		exit;
	}
	$vcalendar = Sabre_VObject_Reader::read($data['calendardata']);
	OC_Calendar_Object::updateVCalendarFromRequest($_POST, $vcalendar);
	$result = OC_Calendar_Object::edit($id, $vcalendar->serialize());
	echo json_encode(array("success"=>"true"));
}
?> 
