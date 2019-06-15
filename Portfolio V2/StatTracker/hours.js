const optionColors = ["A6A6A6", "7030A0", "548235", "FFFF00", "0070C0", "00B0F0", "FF2600", "FF7C00", "404040", "0D0D0D", "30FA00", "FFACA9", "AB82FF", "7A4300"];

var curDayHours;
var prevDayHours;
var nextDayHours;

function FinishLoadDay() {
  UpdateDayHourView();
  program = document.getElementById("program");
  program.setAttribute("style", "display: block;");
}

function SetDayClickEvents(){
  for(i = 0; i < 24; i++){
    hourDiv = document.getElementById("hour" + i);
    for(k = 0; k < 14; k++){
      optionDiv = hourDiv.getElementsByClassName("option" + k)[0];
      optionDiv.setAttribute("onclick", "ClickedOption(" + i + ", " + k + ")");
    }
    selectionDiv = hourDiv.getElementsByClassName("optionSelection")[0];
    xnode = document.createElement("DIV");
    xnode.innerHTML = "x";
    xnode.setAttribute("class", "deleteX");
    xnode.setAttribute("onclick", "ResetOption(" + i + ")");
    selectionDiv.appendChild(xnode);
  }
}

function ChangeDayDisplay(){
  dayLabel = document.getElementById("dayLabel");
  monthYearLabel = document.getElementById("monthYearLabel");

  dateText = curDay.getDate();
  dayLabel.innerHTML = dateText;

  restText = daysOfWeek[curDay.getDay()] + ", " + monthsOfYear[curDay.getMonth()] + ", " + curDay.getFullYear();
  monthYearLabel.innerHTML = restText;
}

function UpdateDayHourView(){
  for(i = 0; i < 24; i++){
    hourDiv = document.getElementById("hour" + i);
    optionsTable = hourDiv.getElementsByClassName("optionsTable")[0];
    optionDiv = hourDiv.getElementsByClassName("optionSelection")[0];

    if(curDayHours[i] != 0){
      optionsTable.setAttribute("style", "display: none;");
      optionDiv.setAttribute("style", "display: block; background-color: #" + optionColors[curDayHours[i]-1] + ";");
    } else {
      optionsTable.setAttribute("style", "");
      optionDiv.setAttribute("style", "display: none;")
    }
  }
}

function UpdateDayHours(){
  curDateID = GenerateDateID(curDay);
  db.collection("Hours").doc(curDateID).get().then(function(doc) {
    if (doc.exists) {
        curDayHours = doc.data().hours;
    } else {
        // doc.data() will be undefined in this case
        curDayHours = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    }
    FinishLoadDay();
  }).catch(function(error) {
    console.log("Error getting document:", error);
  });

  prevDate = new Date(curDay);
  prevDate.setDate(curDay.getDate() - 1);
  prevDateID = GenerateDateID(prevDate);

  db.collection("Hours").doc(prevDateID).get().then(function(doc) {
    if (doc.exists) {
        prevDayHours = doc.data().hours;
    } else {
        // doc.data() will be undefined in this case
        prevDayHours = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    }
  }).catch(function(error) {
    console.log("Error getting previous day:", error);
  });

  nextDate = new Date(curDay);
  nextDate.setDate(curDay.getDate() + 1);
  nextDateID = GenerateDateID(nextDate);

  db.collection("Hours").doc(nextDateID).get().then(function(doc) {
    if (doc.exists) {
        nextDayHours = doc.data().hours;
    } else {
        // doc.data() will be undefined in this case
        nextDayHours = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    }
  }).catch(function(error) {
    console.log("Error getting next day:", error);
  });
}

function ChangeDayHours(fwOrBack) {
  if(fwOrBack == -1){
    curDayHours = prevDayHours;
  } else if(fwOrBack == 1){
    curDayHours = nextDayHours;
  }
  UpdateDayHours();
  UpdateDayHourView();
}

function ClickedOption(hour, option){
  hourDiv = document.getElementById("hour" + hour);
  optionTable = hourDiv.getElementsByClassName("optionsTable")[0];
  optionDiv = hourDiv.getElementsByClassName("optionSelection")[0];

  optionTable.setAttribute("style", "display: none;");
  optionDiv.setAttribute("style", "display: block; background-color: #" + optionColors[option] + ";");

  dateID = GenerateDateID(curDay);
  tempCurDayHours = [];

  db.collection("Hours").doc(dateID).get().then(function(doc) {
    if (!doc.exists) {
      tempCurDayHours = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      tempCurDayHours[hour] = option + 1;
    } else {
      tempCurDayHours = doc.data().hours;
      tempCurDayHours[hour] = option + 1;
    }
    db.collection("Hours").doc(dateID).set({
      hours: tempCurDayHours
    }).then(function() {
      console.log("Hour successfully logged");
    }).catch(function() {
      console.error("Error writing to document: ", error);
    });
  }).catch(function(error) {
    console.log("Error getting document:", error);
  });
}

function ResetOption(hour){
  hourDiv = document.getElementById("hour" + hour);
  optionTable = hourDiv.getElementsByClassName("optionsTable")[0];
  optionDiv = hourDiv.getElementsByClassName("optionSelection")[0];

  optionDiv.setAttribute("style", "display: none;");
  optionTable.setAttribute("style", "");

  dateID = GenerateDateID(curDay);
  tempCurDayHours = [];

  db.collection("Hours").doc(dateID).get().then(function(doc) {
    if (doc.exists) {
      tempCurDayHours = doc.data().hours;
      tempCurDayHours[hour] = 0;
    }
    db.collection("Hours").doc(dateID).set({
      hours: tempCurDayHours
    }).then(function() {
      console.log("Hour successfully reset");
    }).catch(function() {
      console.error("Error writing to document: ", error);
    });
  }).catch(function(error) {
    console.log("Error getting document:", error);
  });
}

function OpenKey() {
  key = document.getElementById("optionKey");
  key.setAttribute("style", "display: block");
}

function CloseKey() {
  key = document.getElementById("optionKey");
  key.setAttribute("style", "display: none");
}
