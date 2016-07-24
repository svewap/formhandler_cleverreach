

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


Reference
^^^^^^^^^

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:
   
   Data type
         Data type:
   
   Description
         Description:
   
   Default
         Default:


.. container:: table-row

   Property
         apiKey
   
   Data type
         string
   
   Description
         Der API-Key
   
   Default


.. container:: table-row

   Property
         listId
   
   Data type
         string
   
   Description
         Gruppen-ID
   
   Default


.. container:: table-row

   Property
         formId
   
   Data type
         string
   
   Description
         Formular-ID
   
   Default


.. container:: table-row

   Property
         unsubscribemethod
   
   Data type
         options
   
   Description
         Wie Benutzer aus der Liste entfernt werden
   
   Default


.. container:: table-row

   Property
         debug
   
   Data type
         int
   
   Description
         Debug Modus
   
   Default


.. ###### END~OF~TABLE ######

Achtung: Falls die Daten nicht korrekt übertragen werden sollten, kann
es daran liegen, dass Sie die Variabeln in CleverReach anders, als die
Standard-Einstellung benannt haben. Dann läuft das mapping natürlich
schief.

Sie können das Mapping ändern, in dem Sie die Beispielkonfigurationen
anpassen. Schauen Sie dazu in die jeweilige setup.txt in den Abschnitt
für den Finisher. Beispiel:

::

   fields {
     # cleverreach api field name
     firstname {
       # form fieldname
       mapping = firstname
     }
   }

