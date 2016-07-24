.. include:: Images.txt

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Installation und Konfiguration
------------------------------

- Installieren Sie die Extension, eventuell vorher die Formhandler
  Extension falls noch nicht vorhanden.

- Diese Extension benötigt die PHP Klasse  **SoapClient** . Eventuell
  muss das entsprechende PHP Modul nachinstalliert werden.

- Fügen Sie die Templates dieser Extension zu Ihrem Haupttemplate hinzu.
  Das Template “Formhandler CleverReach API” ist dabei Minimum. Alle
  anderen Extensions mit Namen “Formhandler CleverReach …..” sind
  optional.

- Geben Sie über den Konstanten-Editor die API-Zugangsdaten von
  CleverReach ein.Die List-ID/Gruppen-ID finden Sie im CleverReach
  System beispielsweise unter:

- |img-7| Die Form-ID finden Sie unter:
  
  |img-8|

- Legen Sie ein neues formhandler Formular an.

- Sie können nun entweder die Beispiele verwenden oder neue formhandler
  Formulare anlegen. Falls Sie ein eigenes anlegen möchten, können Sie
  in den Configuration/TypoScript-Ordner schauen und diese als Vorlage
  verwenden.Um eigene Formulare in formhandler anzulegen, empfehle ich
  die Dokus auf `http://www.typo3-formhandler.com/
  <http://www.typo3-formhandler.com/>`_ .


