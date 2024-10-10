function openModal() {
  const modals = {
    firstStep: document.getElementById("firstStepModal"),
    secondStep: document.getElementById("secondStepModal"),
    thirdStep: document.getElementById("thirdStepModal"),
  };
  
  const buttons = {
    openSecondStep: document.getElementById("openSecondStepModal"),
    openThirdStep: document.getElementById("openThirdStepModal"),
    backToFirst: document.querySelectorAll("#backToFirstModal, #openModal"),
    backToSecond: document.getElementById("backToSecondModal"),
  };

  const showModal = (modal) => {
    Object.values(modals).forEach(m => {
      m.classList.remove("d-block");
      m.classList.add("d-none");
    });
    modal.classList.remove("d-none");
    modal.classList.add("d-block");
  };
  
  buttons.openSecondStep.addEventListener("click", () => showModal(modals.secondStep));
  buttons.openThirdStep.addEventListener("click", () => showModal(modals.thirdStep));
  buttons.backToFirst.forEach((element) => element.addEventListener("click", () => showModal(modals.firstStep)));
  buttons.backToSecond.addEventListener("click", () => showModal(modals.secondStep));
}
