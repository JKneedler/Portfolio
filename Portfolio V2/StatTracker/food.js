function Food(foodName, servingSize, servingName, calories, totalFat, satFat, transFat, monoFat, polyFat, chol, sodium, carbs, fiber, sugar, protein, potassium) {
  this.foodName = foodName;
  this.servingSize = servingSize;
  this.servingName = servingName;
  this.calories = calories;
  this.totalFat = totalFat;
  this.satFat = satFat;
  this.transFat = transFat;
  this.monoFat = monoFat;
  this.polyFat = polyFat;
  this.chol = chol;
  this.sodium = sodium;
  this.carbs = carbs;
  this.fiber = fiber;
  this.sugar = sugar;
  this.protein = protein;
  this.potassium = potassium;
}

var totalDayCons = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

const foodEnum = [
  "foodName",
  "servingSize",
  "servingName",
  "calories",
  "totalFat",
  "satFat",
  "transFat",
  "monoFat",
  "polyFat",
  "chol",
  "sodium",
  "carbs",
  "fiber",
  "sugar",
  "protein",
  "potassium"
]

var curDayFoods = [];
var prevDayFoods = [];
var nextDayFoods = [];

var calGoal;
var carbGoal;
var proteinGoal;
var fatGoal;

var exFoodRow;

function StartUpFoodsPage() {
  GetGoals();
  exFoodRow = document.getElementById("testFoodRow").cloneNode(true);
  document.getElementById("testFoodRow").setAttribute("style", "display: none;");
}

function ChangeFoodDay(fwOrBack){
  if(fwOrBack == -1){
    curDayFoods = prevDayFoods;
  } else if(fwOrBack == 1){
    curDayFoods = nextDayFoods;
  }
  UpdateDayFoods();
  ShowData();
}

function GenerateFoodID(genFood) {
  id = 0;
  for(i = 0; i < genFood.length; i++){
    if(i == 0 || i == 2){
      for(k = 0; k < genFood[i].length; k++){
        id += genFood[i].charCodeAt(k);
      }
    } else {
      id += genFood[i];
    }
  }
  return id;
}

function UpdateDayFoods() {
  curDateID = GenerateDateID(curDay);
  dayFoods = [];

  db.collection("Food").doc(curDateID).collection("Foods").get().then(function(querySnapshot) {
    querySnapshot.forEach(function(doc) {
        // doc.data() is never undefined for query doc snapshots
        var docFood = doc.data().food;
        dayFoods.push(docFood);
    });
    // var testFood = ["Chicken", 1, "test", 150, 10, 0, 0, 0, 0, 0, 0, 5, 0, 0, 25, 0];
    // var testFood2 = ["Salad", 1, "test", 200, 5, 0, 0, 0, 0, 0, 0, 20, 0, 0, 10, 0];
    // var testFood3 = ["Candy", 1, "test", 350, 10, 0, 0, 0, 0, 0, 0, 45, 0, 0, 2, 0];
    // dayFoods.push(testFood);
    // dayFoods.push(testFood2);
    // dayFoods.push(testFood3);
    ShowData();
  }).catch(function(error) {
    console.log("Error getting day data:", error);
  });
  curDayFoods = dayFoods;

  prevDate = new Date(curDay);
  prevDate.setDate(curDay.getDate() - 1);
  prevDateID = GenerateDateID(prevDate);
  prevFoods = [];

  db.collection("Food").doc(prevDateID).collection("Foods").get().then(function(querySnapshot) {
    querySnapshot.forEach(function(doc) {
        // doc.data() is never undefined for query doc snapshots
        var docFood = doc.data().food;
        prevFoods.push(docFood);
    });
  });
  prevDayFoods = prevFoods;

  nextDate = new Date(curDay);
  nextDate.setDate(curDay.getDate() + 1);
  nextDateID = GenerateDateID(nextDate);
  nextFoods = [];

  db.collection("Food").doc(nextDateID).collection("Foods").get().then(function(querySnapshot) {
    querySnapshot.forEach(function(doc) {
        // doc.data() is never undefined for query doc snapshots
        var docFood = doc.data().food;
        nextFoods.push(docFood);
    });
  });
  nextDayFoods = nextFoods;
}

function UpdateDayTotal() {
  totalDayCons = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
  for(i = 0; i < curDayFoods.length; i++){
    for(k = 0; k < curDayFoods[i].length-3; k++){
      totalDayCons[k] += curDayFoods[i][k+3];
    }
  }
}

function UpdateDayTotalView() {
  var calBar = document.getElementById("calPeek");
  var carbBar = document.getElementById("carbPeek");
  var proteinBar = document.getElementById("proteinPeek");
  var fatBar = document.getElementById("fatPeek");

  var calText = document.getElementById("calText");
  var carbText = document.getElementById("carbText");
  var proteinText = document.getElementById("proteinText");
  var fatText = document.getElementById("fatText");

  var calRatio = totalDayCons[0] / calGoal * 100;
  var carbRatio = totalDayCons[8] / carbGoal * 100;
  var proteinRatio = totalDayCons[11] / proteinGoal * 100;
  var fatRatio = totalDayCons[1] / fatGoal * 100;

  if(calRatio > 100) {
    calRatio = 100;
    calText.setAttribute("style", "color: red;");
  } else {
    calText.setAttribute("style", "color: black;");
  }
  if(carbRatio > 100) {
    carbRatio = 100;
    carbText.setAttribute("style", "color: red;");
  } else {
    carbText.setAttribute("style", "color: black;");
  }
  if(proteinRatio > 100) {
    proteinRatio = 100;
    proteinText.setAttribute("style", "color: red;");
  } else {
    proteinText.setAttribute("style", "color: black;");
  }
  if(fatRatio > 100) {
    fatRatio = 100;
    fatText.setAttribute("style", "color: red;");
  } else {
    fatText.setAttribute("style", "color: black;");
  }

  calBar.setAttribute("style", "width: " + calRatio + "%;");
  carbBar.setAttribute("style", "width: " + carbRatio + "%;");
  proteinBar.setAttribute("style", "width: " + proteinRatio + "%;");
  fatBar.setAttribute("style", "width: " + fatRatio + "%;");

  calText.innerHTML = totalDayCons[0] + " / " + calGoal;
  carbText.innerHTML = totalDayCons[8] + " / " + carbGoal;
  proteinText.innerHTML = totalDayCons[11] + " / " + proteinGoal;
  fatText.innerHTML = totalDayCons[1] + " / " + fatGoal;

}

function GetGoals() {

  db.collection("Settings").doc("Food").get().then(function(doc) {
    if (doc.exists) {
      calGoal = doc.data().calGoal;
      carbGoal = doc.data().carbGoal;
      proteinGoal = doc.data().proteinGoal;
      fatGoal = doc.data().fatGoal;
    }
    UpdateDayFoods();
  }).catch(function(error) {
    console.log("Error getting Goals:", error);
  });

}

function ShowData(){
  UpdateDayTotal();
  UpdateDayTotalView();
  UpdateDayFoodView();
}

function UpdateDayFoodView() {
  var foodTable = document.getElementById("foodTable");
  while(foodTable.firstChild){
    foodTable.removeChild(foodTable.firstChild);
  }
  for(i = 0; i < curDayFoods.length; i++){
    var foodNode = exFoodRow.cloneNode(true);
    var nameText = foodNode.getElementsByClassName("foodTitle")[0];
    var carbText = foodNode.getElementsByClassName("carbAmt")[0];
    var fatText = foodNode.getElementsByClassName("fatAmt")[0];
    var proteinText = foodNode.getElementsByClassName("proteinAmt")[0];
    var calText = foodNode.getElementsByClassName("calAmt")[0];
    var delCell = foodNode.getElementsByClassName("delCell")[0];

    nameText.innerHTML = curDayFoods[i][0];
    carbText.innerHTML = curDayFoods[i][11];
    fatText.innerHTML = curDayFoods[i][4];
    proteinText.innerHTML = curDayFoods[i][14];
    calText.innerHTML = curDayFoods[i][3];
    delCell.setAttribute("onclick", "DeleteFood(" + i + ")");

    foodTable.appendChild(foodNode);
  }
}

function openNewFoodWindow() {
  ResetFoodMenuView();

  var newFoodWindow = document.getElementById("newFoodWindow");

  newFoodWindow.setAttribute("style", "display: block");
}

function exitNewFoodWindow() {
  var newFoodWindow = document.getElementById("newFoodWindow");

  newFoodWindow.setAttribute("style", "display: none");
}

function OpenCustomFoodPage() {
  var optionsPage = document.getElementById("newFoodOptions");
  var newCustomPage = document.getElementById("newCustomFood");

  optionsPage.setAttribute("style", "display: none");
  newCustomPage.setAttribute("style", "display: block");
}

function OpenMyFoodsPage() {
  var optionsPage = document.getElementById("newFoodOptions");
  var myFoodsPage = document.getElementById("newMyFood");

  optionsPage.setAttribute("style", "display: none");
  myFoodsPage.setAttribute("style", "display: block");
}

function ResetFoodMenuView() {
  var optionsPage = document.getElementById("newFoodOptions");
  var newCustomPage = document.getElementById("newCustomFood");
  var myFoodsPage = document.getElementById("newMyFood");

  optionsPage.setAttribute("style", "display: block");
  newCustomPage.setAttribute("style", "display: none");
  myFoodsPage.setAttribute("style", "display: none");
}

function CreateNewFood() {
  curDateID = GenerateDateID(curDay);

  newFood = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

  for(i = 0; i < foodEnum.length; i++){
    var foodInfoInput;
    if(i == 0 || i == 2){
      foodInfoInput = document.getElementById(foodEnum[i] + "Input").value;
      document.getElementById(foodEnum[i] + "Input").value = "";
    } else {
      foodInfoInput = parseInt(document.getElementById(foodEnum[i] + "Input").value) || 0;
      document.getElementById(foodEnum[i] + "Input").value = 0;
    }
    newFood[i] = foodInfoInput;
  }

  newFoodID = GenerateFoodID(newFood);

  db.collection("Food").doc("allFoods").collection("Foods").doc("" + newFoodID).set({
    food: newFood
  }).then(function() {
    console.log("New Food successfully added to all foods");
  }).catch(function(error) {
    console.error("Error making new food:", error)
  });

  AddNewFoodToDay(newFood);
  exitNewFoodWindow();
}

function AddNewFoodToDay(newFood) {
  curDateID = GenerateDateID(curDay);

  db.collection("Food").doc("" + curDateID).get().then(function(doc) {
    if(!doc.exists){
      db.collection("Food").doc("" + curDateID).set({testDat: 0}).catch(function(error) {
        console.error("Error creating day document", error);
      });
    }
    db.collection("Food").doc("" + curDateID).collection("Foods").doc("" + newFoodID).set({
      food: newFood
    }).then(function() {
      curDayFoods.push(newFood);
      ShowData();
      console.log("New Food successfully added to day foods");
    }).catch(function(error) {
      console.error("Error adding new food to day:", error)
    });
  }).catch(function(error) {
    console.error("Error retrieving day document", error);
  });
}

function DeleteFood(dayIndex) {
  console.log(dayIndex);

  var foodToDelete = curDayFoods[dayIndex];
  foodID = GenerateFoodID(foodToDelete);
  curDateID = GenerateDateID(curDay);

  db.collection("Food").doc("" + curDateID).collection("Foods").doc("" + foodID).delete().then(function() {
    console.log("Food successfully deleted.");
    UpdateDayFoods();
  }).catch(function(error) {
    console.error("Error deleting food: ", error);
  });
}
