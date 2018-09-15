<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VDS Calculator</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.4/jquery.xdomainrequest.min.js"></script>
</head>
<body>
<main role="main">
    <form action="" method="POST" class="calc">
        <label for="cpu" class="calc-l">
            <h5 class="calc-l__title">Выберите процессор</h5>
            <p>
                <select name="cpu" id="cpu" onchange="onChangeCPU();" class="c-select" required="required">
                    <option selected>Выберите CPU</option>
                </select>
            </p>
        </label>
        <input type="text" name="mb" id="mb_id" hidden>
        <input type="text" name="case" id="case_id" hidden>
        <p id="mb"></p>
        <p id="case"></p>
        <label for="ram" class="calc-l">
            <h5 class="calc-l__title">Выберите ОЗУ</h5>
            <p>
                <select name="ram" id="ram" class="c-select" onchange="onChangeRAM();" required="required">
                    <option selected>Выберите RAM</option>
                </select>
            </p>
        </label>
        <label for="pci" class="calc-l">
            <h5 class="calc-l__title">Выберите PCIE карты</h5>
            <p>
                <select name="pci" id="pci" class="c-select" onchange="onChangeREST()">
                    <option selected>Выберите PCIE карту</option>
                </select>
            </p>
        </label>
        <label for="hdd" class="calc-l">
            <h5 class="calc-l__title">Выберите жёсткий диск</h5>
            <p>
                <select name="hdd" id="hdd" class="c-select" required="required" onchange="onChangeHDD()">
                    <option selected>Выберите HDD</option>
                </select>
            </p>
        </label>
        <button class="c-button__buy" type="submit" id="go" name="go">Заказать</button>
    </form>
    <br>
    <table class="table" id="table_calc">
        <thead class="table-th">
        <tr class="table-th__tr">
            <th class="table-th-tr__th">Наименование</th>
            <th class="table-th-tr__th">Цена</th>
        </tr>
        </thead>
        <tbody class="table-tbody">
        <tr class="table-tbody__tr">
            <td class="table-tbody-tr__td">Процессор</td>
            <td class="table-tbody-tr__td" id="cost_cpu">-</td>
        </tr>
        <tr class="table-tbody__tr">
            <td class="table-tbody-tr__td">Материнская плата</td>
            <td class="table-tbody-tr__td" id="cost_mb">-</td>
        </tr>
        <tr class="table-tbody__tr">
            <td class="table-tbody-tr__td">Корпус</td>
            <td class="table-tbody-tr__td" id="cost_case">-</td>
        </tr>
        <tr class="table-tbody__tr">
            <td class="table-tbody-tr__td">ОЗУ</td>
            <td class="table-tbody-tr__td" id="cost_ram">-</td>
        </tr>
        <tr class="table-tbody__tr">
            <td class="table-tbody-tr__td">PCIE карты</td>
            <td class="table-tbody-tr__td" id="cost_pci">-</td>
        </tr>
        <tr class="table-tbody__tr">
            <td class="table-tbody-tr__td">Жёсткий диск</td>
            <td class="table-tbody-tr__td" id="cost_hdd">-</td>
        </tr>
        <tr class="table-tbody__tr">
            <td class="table-tbody-tr__td">Итого</td>
            <td class="table-tbody-tr__td" id="cost_all">-</td>
        </tr>
        </tbody>
    </table>
</main>
<script src="main.js"></script>
</body>
</html>