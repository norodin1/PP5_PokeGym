const myModal = new bootstrap.Modal(
  document.getElementById("staticBackdropEdit"),
  {}
);
function getValue(property) {
  const form = document.getElementById(formNew);
  console.warn(form);
}

function openModal(pokemon) {
  myModal.show();
  const title = document.getElementById("staticBackdropLabel");
  if (pokemon) {
    document.querySelector('input[name="name"]').value = pokemon["name"];
    document.querySelector('input[name="attack"]').value = pokemon["attack"];
    document.getElementById("atkNum").innerText = pokemon["attack"];
    document.querySelector('input[name="image"]').value = pokemon["image"];
    document.querySelector('input[name="defense"]').value = pokemon["defense"];
    document.getElementById("defNum").innerText = pokemon["defense"];
    document.getElementById("id").value = pokemon["id"];
    document.getElementById("type").value = "edit";
    title.innerText = "Edit Pokemon";
    console.warn(pokemon);
  } else {
    document.querySelector('input[name="type"]').value = "new";
    title.innerText = "Create Pokemon";
  }
}

function onDelete(pokemon) {
  console.warn(pokemon);
}

function onChange(type, event) {
  const target = event.target;
  if (type == "atkNum") {
    document.getElementById(type).innerText = target.value;
  } else if (type == "defNum") {
    document.getElementById(type).innerText = target.value;
  }
}
