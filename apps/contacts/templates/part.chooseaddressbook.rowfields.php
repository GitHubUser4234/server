<?php
	// FIXME: Make this readable.
	echo "<td width=\"20px\"><input id=\"active_" . $_['addressbook']["id"] . "\" type=\"checkbox\" onClick=\"Contacts.UI.Addressbooks.activation(this, " . $_['addressbook']["id"] . ")\"" . (OC_Contacts_Addressbook::isActive($_['addressbook']["id"]) ? ' checked="checked"' : '') . "></td>";
	echo "<td><label for=\"active_" . $_['addressbook']["id"] . "\">" . htmlspecialchars($_['addressbook']["displayname"]) . "</label></td>";
	echo "<td width=\"20px\"><a href=\"#\" onclick=\"Contacts.UI.showCardDAVUrl('" . OC_User::getUser() . "', '" . rawurlencode($_['addressbook']["uri"]) . "');\" title=\"" . $l->t("CardDav Link") . "\" class=\"action\"><img  class=\"svg action\" src=\"../../core/img/actions/public.svg\"></a></td><td width=\"20px\"><a href=\"export.php?bookid=" . $_['addressbook']["id"] . "\" title=\"" . $l->t("Download") . "\" class=\"action\"><img  class=\"svg action\" src=\"../../core/img/actions/download.svg\"></a></td><td width=\"20px\"><a  href=\"#\" title=\"" . $l->t("Edit") . "\" class=\"action\" onclick=\"Contacts.UI.Addressbooks.editAddressbook(this, " . $_['addressbook']["id"] . ");\"><img class=\"svg action\" src=\"../../core/img/actions/rename.svg\"></a></td><td width=\"20px\"><a href=\"#\" onclick=\"Contacts.UI.Addressbooks.deleteAddressbook(this, '" . $_['addressbook']["id"] . "');\" title=\"" . $l->t("Delete") . "\" class=\"action\"><img  class=\"svg action\" src=\"../../core/img/actions/delete.svg\"></a></td>";
