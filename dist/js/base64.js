const input = document.getElementById("selectimage");
const showimage = document.getElementById("showimage");
const imagebase64 = document.getElementById("image-base64");


const convertBase64 = (file) => {
  return new Promise((resolve, reject) => {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(file);

    fileReader.onload = () => {
      resolve(fileReader.result);
    };

    fileReader.onerror = (error) => {
      reject(error);
    };
  });
};

const uploadImage = async (event) => {
  const file = event.target.files[0];
  const base64 = await convertBase64(file);
  showimage.src = base64;
  imagebase64.value = base64;
  console.log(base64);
};

input.addEventListener("change", (e) => {
  uploadImage(e);
});