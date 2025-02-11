# Laravel To Upper

## 📌 Sobre o Projeto
O **Laravel To Upper** é um package para Laravel que coloca em maiusculo dados do ao serem inseridos no banco de dados.

---

## 🚀 Instalação

### 1️⃣ Requisitos
Antes de instalar, certifique-se de que seu projeto atenda aos seguintes requisitos:
- PHP >= 8.0
- Laravel >= 10
- Composer instalado

### 2️⃣ Instalação do Package
Execute o seguinte comando no terminal:
```bash
  composer require risetechapps/to-upper-for-laravel
```

### 3️⃣ Configurar Model
```bash
  use RiseTechApps\ToUpper\Traits\HasToUpper;
  
  class Client extends Model
  {
    use HasFactory, HasToUpper;
  }
```

---

## 🛠 Contribuição
Sinta-se à vontade para contribuir! Basta seguir estes passos:
1. Faça um fork do repositório
2. Crie uma branch (`feature/nova-funcionalidade`)
3. Faça um commit das suas alterações
4. Envie um Pull Request

---

## 📜 Licença
Este projeto é distribuído sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

💡 **Desenvolvido por [Rise Tech](https://risetech.com.br)**

