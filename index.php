<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Substation Dashboard</title>

<style>
body {
    font-family: Arial;
    background:#111;
    color:white;
    margin:0;
}

.container {
    width:95%;
    margin:auto;
}

/* NAV */
.nav {
    text-align:center;
    margin:15px 0;
}

.nav button {
    font-size:20px;
    margin:5px;
    padding:8px 15px;
    border:none;
    border-radius:5px;
    background:#333;
    color:white;
}

#hourLabel {
    font-size:18px;
    margin:0 10px;
}

/* CARD */
.card {
    background:#222;
    padding:15px;
    border-radius:10px;
    max-width:900px;
    margin:auto;
}

.row {
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
}

.row input {
    width:70px;
    margin:4px;
    padding:6px;
    border-radius:5px;
    border:none;
    text-align:center;
}

/* SLIDER */
.slide {
    display:none;
}

.slide.active {
    display:block;
}

/* BUTTONS */
button {
    padding:6px 12px;
    border:none;
    border-radius:5px;
    background:#00c853;
    color:white;
    cursor:pointer;
}

.generate {
    background:#2962ff;
}

/* MOBILE */
@media (max-width:600px){
    .row input {
        width:45%;
    }
}
</style>
</head>

<body>

<div class="container">

<h2 style="text-align:center;">⚡ Substation Monitoring</h2>

<!-- NAV -->
<div class="nav">
    <button onclick="prevCard()">⬅</button>
    <span id="hourLabel">Hour 1</span>
    <button onclick="nextCard()">➡</button>
</div>

<div class="slider">

<?php 
function v($row, $key){
    return isset($row[$key]) ? $row[$key] : '';
}

for ($h=1; $h<=23; $h++) { 

$res = $conn->query("SELECT * FROM readings WHERE hour=$h");
$row = $res->fetch_assoc();
?>

<div class="card slide" id="hour<?php echo $h; ?>">

<form action="save.php" method="POST">

<h3>🕒 Hour <?php echo $h; ?></h3>
<input type="hidden" name="hour" value="<?php echo $h; ?>">

<!-- 🔴 MAIN FEEDER -->
<h4>🔴 MAIN FEEDER</h4>
<div class="row">
<input name="mf_l1l2" value="<?= v($row,'mf_l1l2') ?>" placeholder="L1L2">
<input name="mf_l2l3" value="<?= v($row,'mf_l2l3') ?>" placeholder="L2L3">
<input name="mf_l3l1" value="<?= v($row,'mf_l3l1') ?>" placeholder="L3L1">

<input name="mf_a" value="<?= v($row,'mf_a') ?>" placeholder="A">
<input name="mf_b" value="<?= v($row,'mf_b') ?>" placeholder="B">
<input name="mf_c" value="<?= v($row,'mf_c') ?>" placeholder="C">
<input name="mf_n" value="<?= v($row,'mf_n') ?>" placeholder="N">

<input name="mf_l1" value="<?= v($row,'mf_l1') ?>" placeholder="L1">
<input name="mf_l2" value="<?= v($row,'mf_l2') ?>" placeholder="L2">
<input name="mf_l3" value="<?= v($row,'mf_l3') ?>" placeholder="L3">

<input name="mf_energy" value="<?= v($row,'mf_energy') ?>" placeholder="Energy">
<input name="mf_gas" value="<?= v($row,'mf_gas') ?>" placeholder="Gas">
</div>

<!-- 🟡 FEEDER 7 -->
<h4>🟡 FEEDER 7</h4>
<div class="row">
<input name="f7_a" value="<?= v($row,'f7_a') ?>" placeholder="A">
<input name="f7_b" value="<?= v($row,'f7_b') ?>" placeholder="B">
<input name="f7_c" value="<?= v($row,'f7_c') ?>" placeholder="C">
<input name="f7_n" value="<?= v($row,'f7_n') ?>" placeholder="N">

<input name="f7_pf_a" value="<?= v($row,'f7_pf_a') ?>" placeholder="PF A">
<input name="f7_pf_b" value="<?= v($row,'f7_pf_b') ?>" placeholder="PF B">
<input name="f7_pf_c" value="<?= v($row,'f7_pf_c') ?>" placeholder="PF C">
<input name="f7_pf_avg" value="<?= v($row,'f7_pf_avg') ?>" placeholder="PF Avg">

<input name="f7_l1" value="<?= v($row,'f7_l1') ?>" placeholder="L1">
<input name="f7_l2" value="<?= v($row,'f7_l2') ?>" placeholder="L2">
<input name="f7_l3" value="<?= v($row,'f7_l3') ?>" placeholder="L3">

<input name="f7_energy" value="<?= v($row,'f7_energy') ?>" placeholder="Energy">
<input name="f7_batt" value="<?= v($row,'f7_batt') ?>" placeholder="Battery">
</div>

<!-- 🟢 FEEDER 8 -->
<h4>🟢 FEEDER 8</h4>
<div class="row">
<input name="f8_a" value="<?= v($row,'f8_a') ?>" placeholder="A">
<input name="f8_b" value="<?= v($row,'f8_b') ?>" placeholder="B">
<input name="f8_c" value="<?= v($row,'f8_c') ?>" placeholder="C">
<input name="f8_n" value="<?= v($row,'f8_n') ?>" placeholder="N">

<input name="f8_pf_a" value="<?= v($row,'f8_pf_a') ?>" placeholder="PF A">
<input name="f8_pf_b" value="<?= v($row,'f8_pf_b') ?>" placeholder="PF B">
<input name="f8_pf_c" value="<?= v($row,'f8_pf_c') ?>" placeholder="PF C">
<input name="f8_pf_avg" value="<?= v($row,'f8_pf_avg') ?>" placeholder="PF Avg">

<input name="f8_l1" value="<?= v($row,'f8_l1') ?>" placeholder="L1">
<input name="f8_l2" value="<?= v($row,'f8_l2') ?>" placeholder="L2">
<input name="f8_l3" value="<?= v($row,'f8_l3') ?>" placeholder="L3">

<input name="f8_energy" value="<?= v($row,'f8_energy') ?>" placeholder="Energy">
</div>

<!-- 🔵 FEEDER 9 -->
<h4>🔵 FEEDER 9</h4>
<div class="row">
<input name="f9_a" value="<?= v($row,'f9_a') ?>" placeholder="A">
<input name="f9_b" value="<?= v($row,'f9_b') ?>" placeholder="B">
<input name="f9_c" value="<?= v($row,'f9_c') ?>" placeholder="C">
<input name="f9_n" value="<?= v($row,'f9_n') ?>" placeholder="N">

<input name="f9_pf_a" value="<?= v($row,'f9_pf_a') ?>" placeholder="PF A">
<input name="f9_pf_b" value="<?= v($row,'f9_pf_b') ?>" placeholder="PF B">
<input name="f9_pf_c" value="<?= v($row,'f9_pf_c') ?>" placeholder="PF C">
<input name="f9_pf_avg" value="<?= v($row,'f9_pf_avg') ?>" placeholder="PF Avg">

<input name="f9_l1" value="<?= v($row,'f9_l1') ?>" placeholder="L1">
<input name="f9_l2" value="<?= v($row,'f9_l2') ?>" placeholder="L2">
<input name="f9_l3" value="<?= v($row,'f9_l3') ?>" placeholder="L3">

<input name="f9_energy" value="<?= v($row,'f9_energy') ?>" placeholder="Energy">
</div>

<br>
<div style="text-align:center;">
<button type="submit">💾 Save</button>
</div>

</form>
</div>

<?php } ?>

</div>

<!-- GENERATE -->
<div style="text-align:center; margin:20px;">
<a href="generate.php">
<button class="generate">📄 Generate Excel Report</button>
</a>
</div>

</div>

<!-- JAVASCRIPT -->
<script>
let current = 1;
const total = 23;

function showCard(n){
    document.querySelectorAll('.slide').forEach(s => s.classList.remove('active'));
    document.getElementById('hour'+n).classList.add('active');
    document.getElementById('hourLabel').innerText = "Hour " + n;
}

function nextCard(){
    if(current < total){
        current++;
        showCard(current);
    }
}

function prevCard(){
    if(current > 1){
        current--;
        showCard(current);
    }
}

// INIT
showCard(1);
</script>

</body>
</html>