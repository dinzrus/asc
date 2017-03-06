<!doctype html>
<html lang="en">
    <head>
        <title></title>
    </head>
    <body>
        <table class="table table-bordered table-condensed" style="font-size: 11px">
            <thead>
                <tr>
                    <th></th>
                    <th style="vertical-align: middle; text-align: center">Name</th>
                    <th style="vertical-align: middle; text-align: center">Card No.</th>
                    <th style="vertical-align: middle; text-align: center">Prev. Daily</th>
                    <th style="vertical-align: middle; text-align: center">New Daily</th>
                    <th style="vertical-align: middle; text-align: center">Gross Amt.</th>
                    <th style="vertical-align: middle; text-align: center">VAT</th>
                    <th style="vertical-align: middle; text-align: center">Gas</th>
                    <th style="vertical-align: middle; text-align: center">Admin</th>
                    <th style="vertical-align: middle; text-align: center">Total VNA</th>
                    <th style="vertical-align: middle; text-align: center">Net Amt</th>
                    <th style="vertical-align: middle; text-align: center">Net Proceeds</th>
                    <th style="vertical-align: middle; text-align: center">Final Bal./SF/</th>
                    <th style="vertical-align: middle; text-align: center">Actual Net.</th>
                    <th style="vertical-align: middle; text-align: center">Type of Loan</th>
                    <th style="vertical-align: middle; text-align: center">Collector's Confirmation</th>
                    <th style="vertical-align: middle; text-align: center">Releasing Officer (Sig. Overname)</th>
                    <th style="vertical-align: middle; text-align: center">Canvasser</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i < 10; $i++): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td width="15%">Alicaway, Ma. Jocelyn</td>
                        <td>2661313454</td>
                        <td>500</td>
                        <td>700</td>
                        <td>5,000</td>
                        <td>300</td>
                        <td>300</td>
                        <td>300</td>
                        <td>300</td>
                        <td>300</td>
                        <td>300</td>
                        <td>11,000</td>
                        <td>4000</td>
                        <td>New</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </body>
</html>