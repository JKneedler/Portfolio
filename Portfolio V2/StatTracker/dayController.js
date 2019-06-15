const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const monthsOfYear = ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];

var curDay;

function ChangeDay(fwOrBack){
  var newDate = new Date(curDay);
  curDay.setDate(newDate.getDate() + fwOrBack);
  ChangeDayDisplay();
  ChangeDayHours(fwOrBack);
  ChangeFoodDay(fwOrBack);
}

function GenerateDateID(genDate){
  id = "";
  dd = genDate.getDate();
  mm = genDate.getMonth() + 1;
  yyyy = "" + genDate.getFullYear();
  if(mm < 10){
    id += "0" + mm;
  } else {
    id += mm;
  }
  if(dd < 10){
    id += "0" + dd;
  } else {
    id += dd;
  }
  id += yyyy;
  return id;
}
