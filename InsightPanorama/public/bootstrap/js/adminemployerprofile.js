var table = document.getElementById('unverified_profile_tbl'),
rIndex;
for (var i = 1; i < table.rows.length; i++) {
table.rows[i].onclick = function() {
  //Gets the row index
  rIndex = this.rowIndex;
  // console.log(rIndex);
  document.getElementById('account_id').value = this.cells[0].innerHTML;
}
}
var table = document.getElementById('verified_profile_tbl'),
rIndex;
for (var i = 1; i < table.rows.length; i++) {
table.rows[i].onclick = function() {
  //Gets the row index
  rIndex = this.rowIndex;
  // console.log(rIndex);
  document.getElementById('account_id1').value = this.cells[0].innerHTML;
}
}
document.querySelector('#verified_profile_tbl').addEventListener('click', function(e) {
var closestCell = e.target.closest('tr'), // identify the closest td when the click occured
  activeCell = e.currentTarget.querySelector('tr.selected'); // identify the already selected td

closestCell.classList.add('selected'); // add the "selected" class to the clicked td
if (activeCell) activeCell.classList.remove('selected'); // remove the "selected" class from the previously selected td
})

document.querySelector('#unverified_profile_tbl').addEventListener('click', function(e) {
var closestCell = e.target.closest('tr'), // identify the closest td when the click occured
  activeCell = e.currentTarget.querySelector('tr.selected'); // identify the already selected td

closestCell.classList.add('selected'); // add the "selected" class to the clicked td
if (activeCell) activeCell.classList.remove('selected'); // remove the "selected" class from the previously selected td
})