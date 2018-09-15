var selectCPU,
    selectMB,
    selectCASE,
    selectRAM,
    selectPCIE,
    selectHDD;
var countCPU,
    countRAM,
    countPCIE,
    countHDD,
    countServer,
    countAll;
var CPUS = [],
    MB,
    CASES,
    RAM;
var costCpu = 0,costCase = 0,costMb = 0,costRam = 0,costPcie = 0,costHdd = 0;
var g_data = $.ajax({
    url: "http://masstek.ru/calc/components.php?delay=1&stock=data",
    async: false
}).responseText;
g_data = JSON.parse(g_data);

$(document).ready(function(){
    console.log(g_data);
    init();
});

function init(){
    insertCPUS(CPUS, g_data, '#cpu');
}

function insertCPUS(CPUS, data, cpu_selector){
    var html = '',
        id,
        price,
        name;
    data = data['cpu'];
    $.each(data, function (key, val) {
        id = val.id;
        price = val.value / 100;
        name = val.name;
        CPUS.push({id:id,name:name,price:price});
        html += `<option value="${id}">${name} - ${price} RUB.</option>`;
    });
    $(cpu_selector).append(html);
    return CPUS;
}

function updateMB(){
    var text = '',
        mb2cpu,
        min = 9000000,
        name;
    mb2cpu = g_data['mb2cpu'];
    MB = g_data['motherboard'];
    $.each(mb2cpu, function (key, val) {
        if(val.CPU == selectCPU.id){
            if(MB[val.MB].value < min) {
                selectMB = MB[val.MB];
                text = 'Материнская плата: ' + selectMB.name;
                min = MB[val.MB].value;
            }
        }
    });
    costMb = selectMB.value / 100;
    $('#cost_mb').text(selectMB.value / 100 + ' RUB.');
    $('#mb').text(text);
    $('#mb_id').val(selectMB.id);
}

function updateCASE(){
    var text = '',
        mb2case,
        name,
        min = 900000,
        price;
    mb2case = g_data['mb2case'];
    CASES = g_data['box'];
    $.each(mb2case, function (key, val) {
        if(val.MB == selectMB.id){
            price = CASES[val.CASE].value / 100;
            if(price < min) {
                selectCASE = CASES[val.CASE];
                min = price;
            }
        }
    });
    text = 'Корпус: ' + selectCASE.name;
    costCase = selectCASE.value/100;
    $('#cost_case').text(selectCASE.value/100 + ' RUB.');
    $('#case').text(text);
    $('#case_id').val(selectCASE.id);
}
function updateCPU(){
    var price = selectCPU.price;
    costCpu = price;
    $('#cost_cpu').text(price + ' RUB.');
}
function updateCost() {
    var cost = costCase + costCpu + costHdd + costMb + costPcie + costRam;
    $('#cost_all').text(cost + ' RUB.');
}

function dropForm() {
    updateCPU();
    updateMB();
    updateCASE();
    insertRAMS();
}

function insertRAMS() {
    var html = '<option selected>Выберите RAM</option>',
        mb2ram;
    mb2ram = g_data['mb2ram'];
    RAM = g_data['ram'];
    $.each(mb2ram, function (key, val) {
        if(selectMB.id == val.MB) {
            id = RAM[val.MB].id;
            name = RAM[val.MB].name;
            price = RAM[val.MB].value/100;
            html += `<option value="${id}">${name} - ${price} RUB.</option>`;
        }
    });
    $('#ram').html(html);
}

function updateRAM(){
    costRam = selectRAM.value/100;
    $('#cost_ram').text(costRam + ' RUB.');
    updateCost();
}

function onChangeRAM() {
    var id = $('#cpu option:selected').val();
    selectRAM = RAM[id];
    updateRAM();
}

function onChangeCPU(){
    var id = $('#cpu option:selected').val();
    id--;
    selectCPU = CPUS[id];
    dropForm();
    updateCost();
}