export const validaCPF = (cpf) => {
    cpf = cpf.replace(/[^0-9]/g, '');

    if (cpf.length !== 11) {
      return false;
    }

    if (/(\d)\1{10}/.test(cpf)) {
      return false;
    }

    for (let t = 9; t < 11; t++) {
      let d = 0;
      for (let c = 0; c < t; c++) {
        d += parseInt(cpf.charAt(c)) * ((t + 1) - c);
      }
      d = ((10 * d) % 11) % 10;
      if (parseInt(cpf.charAt(t)) !== d) {
        return false;
      }
    }
    return true;
  }
