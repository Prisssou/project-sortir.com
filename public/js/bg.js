function newStyle() {
    let newColor = '';
    let newFont = ''; 
    let newBackgroundImage = '';
    let newBackgroundColor = '';
    let x = Math.floor(Math.random()*7); 
    switch (x){
      case 0:
        newBackgroundImage = "url('img/popcorn.jpg')";
        break;
      case 1: 
      newBackgroundImage = "url('img/bar.jpg')";
        break;
      case 2:
        newBackgroundImage = "url('img/bowling.jpg')";
        break; 
      case 3:
        newBackgroundImage = "url('img/cheers.jpg')";
        break
      case 4:
        newBackgroundImage = "url('img/museum.jpg')";
        break;
      case 5:
        newBackgroundImage = "url('img/popcorn.jpg')";
          break;
      case 6: 
      newBackgroundImage = "url('img/popcorn.jpg')";
          break;
    }
    const elem = document.getElementById('welcome');
    elem.style.color = newColor;
    elem.style.fontFamily = newFont; 
    elem.style.backgroundImage = newBackgroundImage;
    elem.style.backgroundColor = newBackgroundColor;

  }
  