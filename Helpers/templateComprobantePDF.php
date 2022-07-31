<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante PDF - <?= $payment->getVoucherCode(); ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: separate;
        }

        .header {
            margin-bottom: 20px;
        }

        .header img {
            object-fit: contain;
            width: 200px;
            height: 70px;
        }

        .header td {
            width: 33.3%;
            text-align: center;
            padding: 20px;
        }
        
        .header__stamp {
            border: 3px solid #999;
            font-weight: bold;
        }

        .header strong {
            font-size: 20px;
        }

        .info {
            border-collapse: collapse;
            margin-bottom: 30px;
            margin-top: 30px;
        }
        
        .info td {
            padding: 10px;
        }

        .info__key {
            font-weight: bold;
        }

        .info__cell--short {
            width: 130px;
        }

        .info__cell--large {
            width: 200px;
        }

        .data {
            width: 100%;
            border-collapse: collapse;
        }

        .data th {
            border: 1px solid #000;
        }

        .data th,
        .data td {
            padding: 10px;
            width: 39px;
            text-align: center;
        }

        .data__cell--large {
            width: 300px;
        }

        .price {
            border-collapse: separate;
            margin-top: 20px;
            width: 100%;
        }

        .price tr {
            width: 100%;
        }
        
        .price td {
            width: 25%;
            padding: 10px;
        }
        
        .price__cell {
            border: 1px solid #000;
            text-align: center;
        }
    </style>
</head>
<body>
    <table class="header">
        <tr>
            <td>
                <img src="<?= $logoBase64 ?>" alt="">
            </td>
            <td>
                <strong>JQUEENS S.A.C.</strong>
                <br><br>Av. San Juan, Calle 123 - San Juan de Miraflores
            </td>
            <td class="header__stamp">
                RUC: 2010201020<br><br>
                BOLETA DE VENTA ELECTRÓNICA<br><br>
                Nro. <?= $payment->getVoucherCode(); ?>
            </td>
        </tr>
    </table>

    <table class="info">
        <tr>
            <td class="info__key info__cell--short">Nombre</td>
            <td class="info__cell--large">: <?= $user->getFullname(); ?></td>
            <td class="info__key info__cell--short">F. Emisión</td>
            <td class="info__cell--short">: <?= $payment->getPaymentDate(); ?></td>
        </tr>
        <tr>
            <td class="info__key info__cell--short">DNI</td>
            <td class="info__cell--large">: <?= $user->getDni(); ?></td>
            <td class="info__key info__cell--short">Moneda</td>
            <td class="info__cell--short">: SOLES</td>
        </tr>
        <tr>
            <td class="info__key info__cell--short">Dirección</td>
            <td class="info__cell--large">: <?= $user->getAddress(); ?></td>
            <td class="info__key info__cell--short">Precio por Reserva</td>
            <td class="info__cell--short">: <sup>s</sup>/.<?= $payment->getReservaPrice(); ?></td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>Item</th>
                <th class="data__cell--large">Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Descuento</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $nroItem = 0;
                $cantidad = 1;
                $descuento = 0.0; 
            ?>
            <?php foreach ($services as $key => $service) { ?>
                <tr>
                    <td><?= $nroItem++; ?></td>
                    <td class="data__cell--large"><?= $service->getDescription(); ?></td>
                    <td><?= $cantidad; ?></td>
                    <td><sup>s</sup>/.<?= $service->getPrice(); ?></td>
                    <td><sup>s</sup>/.<?= $descuento; ?></td>
                    <td><sup>s</sup>/. <?= ($service->getPrice() * $cantidad); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <table class="price">
        <tr>
            <td></td>
            <td></td>
            <td class="info__key price__cell">Importe Total</td>
            <td class="price__cell"><sup>s</sup>/.<?= $payment->getTotalPrice(); ?></td>
        </tr>
    </table>
</body>
</html>