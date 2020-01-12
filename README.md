# momo_preciousmetal

TYPO3 extension displays gold rates in chart and table view beginning from 2014.

1. Install TYPO3 Extension momo_preciousmetal and include static from extension.
2. Import CSV-File(XAU rates from 2014 in EUR and USD) with backend-module under "ADMIN TOOLS"
3. Configure task with scheduler to update the table from monday till friday day at 8:30 AM CET (30 8 * * 1-5).
4. Create two pages with plugin momopreciousmetal_pmlisting and momopreciousmetal_pmchart.

Frontend needs jQuery and Bootstrap would be nice.
