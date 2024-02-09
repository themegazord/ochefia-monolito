export const validaCNPJ = (cnpj) => {
    cnpj = cnpj.replace(/[^0-9]/g, '')

    if (cnpj.length !== 14) {
      return false
    }

    if (/(\d)\1{13}/.test(cnpj)) {
      return false
    }

    let soma = 0
    let j = 5
    for (let i = 0; i < 12; i++) {
      soma += parseInt(cnpj.charAt(i)) * j
      j = j === 2 ? 9 : j - 1
    }

    const resto = soma % 11

    if (parseInt(cnpj.charAt(12)) !== (resto < 2 ? 0 : 11 - resto)) {
      return false
    }

    soma = 0
    j = 6
    for (let i = 0; i < 13; i++) {
      soma += parseInt(cnpj.charAt(i)) * j
      j = j === 2 ? 9 : j - 1
    }

    const segundoDigito = soma % 11

    return parseInt(cnpj.charAt(13)) === (segundoDigito < 2 ? 0 : 11 - segundoDigito)
  }
