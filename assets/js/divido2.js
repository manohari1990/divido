function getJSONString(inputStr){
  let ResultString = '';
  let mergedObject = [];
  $.getJSON(AppBasePath + 'FileOperation/getFileContent', function (res) {
    console.log(res);
    try {
      res.ResultArray.forEach(element => {
        mergedObject = {
          ...element
        };
      });
      ResultString = JSON.stringify(index(mergedObject, inputStr));
      document.getElementById('ResultString').innerHTML = '<p class="labels">Result: </p>' + ResultString;

      document.getElementById('ErrorFileString').innerHTML = '<p class="labels">Error File list: </p>' + res.errorFiles.toString();
    } catch (e) {
      console.log(e);
    }
  });
}

function index(obj,is) {
  let value = is.split('.')
  return value.reduce((o,i)=>o[i], obj);
}