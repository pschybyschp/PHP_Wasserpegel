# PHP_Watergauge
With PHP_Wasserpegel you can load water related data from the Wasserpegel API (https://www.pegelonline.wsv.de/webservice/dokuRestapi#ressourcenMeasurement) provided by the German WSV.
It consist of 2 php files and a json based helper file.

Initail file: WSV_pegel.php
The WSV_pegel.php consist of a drop-down with hardcoded selectable waters in Germany.
Additionally there are also 2 buttons which enables showing and hiding timeseries related data within the result table using JQuery.
Finally there is a dynamic result table which display the data requested from Wasserpegel API.
The data displayed in the result table is originally taken from the Wasserpegel API but actually the json based helper file serves here as data source. 

Helper file: wsv.json
This json based helper file is initially generated when the WSV_pegel.php is initiated and it is always recreated when a selection of the hardcoded waters is done.
So when the WSV_pegel.php is initially run all data from Wasserpegel API is requested using Curl and written down to the helper file.
Afterwards the data from the json file is used to populate the result table of the WSV_pegel.php with a (nested) For-loop.

Result file: WSV_pegel_results.php
When selecting one of the hardcoded waters from the dropdown list the selected value will be provided as GET-variable to the second php script, WSV_pegel_result.php.
Based on the selection data will be requested from Wasserpegel API and written down to the json based helper file.

