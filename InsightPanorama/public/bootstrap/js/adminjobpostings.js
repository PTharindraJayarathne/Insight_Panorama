var table = document.getElementById('unverified_job_tbl'),
rIndex;
for (var i = 1; i < table.rows.length; i++) {
table.rows[i].onclick = function() {

  rIndex = this.rowIndex;

  document.getElementById('jobidfield').value = this.cells[0].innerHTML;
}
}
var table2 = document.getElementById('accepted_job_tbl'),
rIndex;
for (var i = 1; i < table2.rows.length; i++) {
table2.rows[i].onclick = function() {

  rIndex = this.rowIndex;

  document.getElementById('ajobidfield').value = this.cells[0].innerHTML;
}
}
var table3 = document.getElementById('rejected_job_tbl'),
rIndex;
for (var i = 1; i < table3.rows.length; i++) {
table3.rows[i].onclick = function() {

  rIndex = this.rowIndex;

  document.getElementById('rjobidfield').value = this.cells[0].innerHTML;
}
}


document.querySelector('#unverified_job_tbl').addEventListener('click', function(e) {
var closestCell = e.target.closest('tr'), 
  activeCell = e.currentTarget.querySelector('tr.selected'); 

closestCell.classList.add('selected');
if (activeCell) activeCell.classList.remove('selected'); 
})