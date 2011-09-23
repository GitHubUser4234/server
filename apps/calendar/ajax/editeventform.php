<?php
/*************************************************
 * ownCloud - Calendar Plugin                     *
 *                                                *
 * (c) Copyright 2011 Bart Visscher               *
 * License: GNU AFFERO GENERAL PUBLIC LICENSE     *
 *                                                *
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

$calendar_options = OC_Calendar_Calendar::allCalendars(OC_User::getUser());
$category_options = OC_Calendar_Object::getCategoryOptions($l10n);
$repeat_options = OC_Calendar_Object::getRepeatOptions($l10n);

$id = $_GET['id'];
$data = OC_Calendar_Object::find($id);
$calendar = OC_Calendar_Calendar::findCalendar($data['calendarid']);
if($calendar['userid'] != OC_User::getUser()){
		echo $l10n->t('Wrong calendar');
		exit;
}
$object = Sabre_VObject_Reader::read($data['calendardata']);
$vevent = $object->VEVENT;
$dtstart = $vevent->DTSTART;
$dtend = $vevent->DTEND;
switch($dtstart->getDateType()) {
	case Sabre_VObject_Element_DateTime::LOCALTZ:
		$startdate = $dtstart->getDateTime()->format('d-m-Y');
		$starttime = $dtstart->getDateTime()->format('H:i');
		$enddate = $dtend->getDateTime()->format('d-m-Y');
		$endtime = $dtend->getDateTime()->format('H:i');
		$allday = false;
		break;
	case Sabre_VObject_Element_DateTime::DATE:
		$startdate = $dtstart->getDateTime()->format('d-m-Y');
		$starttime = '';
		$dtend->getDateTime()->modify('-1 day');
		$enddate = $dtend->getDateTime()->format('d-m-Y');
		$endtime = '';
		$allday = true;
		break;
}

$summary = isset($vevent->SUMMARY) ? $vevent->SUMMARY->value : '';
$location = isset($vevent->LOCATION) ? $vevent->LOCATION->value : '';
$categories = array();
if (isset($vevent->CATEGORIES)){
       $categories = explode(',', $vevent->CATEGORIES->value);
       $categories = array_map('trim', $categories);
}
$repeat = isset($vevent->CATEGORY) ? $vevent->CATEGORY->value : '';
$description = isset($vevent->DESCRIPTION) ? $vevent->DESCRIPTION->value : '';

$tmpl = new OC_Template('calendar', 'part.editevent');
$tmpl->assign('id', $id);
$tmpl->assign('calendar_options', $calendar_options);
$tmpl->assign('category_options', $category_options);
$tmpl->assign('repeat_options', $repeat_options);

$tmpl->assign('title', $summary);
$tmpl->assign('location', $location);
$tmpl->assign('categories', $categories);
$tmpl->assign('calendar', $data['calendarid']);
$tmpl->assign('allday', $allday);
$tmpl->assign('startdate', $startdate);
$tmpl->assign('starttime', $starttime);
$tmpl->assign('enddate', $enddate);
$tmpl->assign('endtime', $endtime);
$tmpl->assign('repeat', $repeat);
$tmpl->assign('description', $description);
$tmpl->printpage();
?>
 
