
function generateAvatar(text, foregroundColor, backgroundColor) {
    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");

    backgroundColor = "#" + genColor(ascii_code(text));
    canvas.width = 200;
    canvas.height = 200;

    // Draw background
    context.fillStyle = backgroundColor;
    context.fillRect(0, 0, canvas.width, canvas.height);

    // Draw text
    context.font = "bold 90px Helvetica";
    context.fillStyle = foregroundColor;
    context.textAlign = "center";
    context.textBaseline = "middle";
    context.fillText(text, canvas.width / 2, canvas.height / 2);

    return canvas.toDataURL("image/png");
}

function genColor (seed) {
  color = Math.floor((Math.abs(Math.sin(seed) * 16777215)));
  color = color.toString(16);
  // pad any colors shorter than 6 characters with leading 0s
  while(color.length < 6) {
    color = '0' + color;
  }
  console.log("color: " + color);
  return color;
}

function ascii_code (character) {

  // Get the decimal code
  let code = character.charCodeAt(0);

  // If the code is 0-127 (which are the ASCII codes,
  if (code < 128) {

    // Return the code obtained.
    return code;

  // If the code is 128 or greater (which are expanded Unicode characters),
  }else{

    // Return -1 so the user knows this isn't an ASCII character.
    return -1;
  };
};
