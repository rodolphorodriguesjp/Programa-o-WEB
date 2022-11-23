class Aluno {

    nome;
    matricula;
    nota1;
    nota2;
    nota3;
    media;
  
    constructor(nome, matricula, nota1, nota2, nota3) {
  
       this.nome = nome;
       this.matricula = matricula;
       this.nota1 = nota1;
       this.nota2 = nota2;
       this.nota3 = nota3;
       this.media = this.calculaMedia(nota1, nota2, nota3);
       
       this.arrayAlunos = [];
  
    }

    adicionar(aluno) {
      this.arrayAlunos.push(aluno);
    }
    
    salvar(){
      let aluno = this.lerDados();

      if(this.validaCampos(aluno) == true){
        this.adicionar(aluno);
        
      }

      this.listaTabela();
      this.limpar();
    }

    listaTabela(){
      let tbody = document.querySelector('#tbody');
      tbody.innerText = '';

      for(let i = 0; i < this.arrayAlunos.length; i++){
        let tr = tbody.insertRow();
        let nome = tr.insertCell();
        let matricula = tr.insertCell();
        let nota1 = tr.insertCell();
        let nota2 = tr.insertCell();
        let nota3 = tr.insertCell();
        let media = tr.insertCell();
        let excluir = tr.insertCell();
    
        nome.innerText = this.arrayAlunos[i].nome;
        matricula.innerText = this.arrayAlunos[i].matricula;
        nota1.innerText = this.arrayAlunos[i].nota1;
        nota2.innerText = this.arrayAlunos[i].nota2;
        nota3.innerText = this.arrayAlunos[i].nota3;
        media.innerText = this.arrayAlunos[i].media;

        let imgDelete = document.createElement('i');
        imgDelete.classList.add('bi');
        imgDelete.classList.add('bi-trash')
        imgDelete.setAttribute("onclick","aluno.deletar("+this.arrayAlunos[i].matricula+")");

        excluir.appendChild(imgDelete);
        excluir.classList.add('center');

      }
    }

    lerDados() {
      let aluno = {}
      
      aluno.nome = document.querySelector('#nome').value;
      aluno.matricula = document.querySelector('#matricula').value;
      aluno.nota1 = parseFloat(document.querySelector('#nota1').value);
      aluno.nota2 = parseFloat(document.querySelector('#nota2').value);
      aluno.nota3 = parseFloat(document.querySelector('#nota3').value);
      aluno.media = this.calculaMedia(aluno.nota1, aluno.nota2, aluno.nota3);

      return aluno;
    }
    
    validaCampos(aluno) {
      
      for(let i = 0; i < this.arrayAlunos.length; i++){
        if (aluno.matricula == this.arrayAlunos[i].matricula){
          alert('Matricula já foi adicionada ao diário de classe');
          return false;
        }
      }

      return true;
    }
    
    deletar(matricula){

      if(confirm('Excluir notas avaliativas do aluno '+ matricula +' ?')){

      let tbody = document.querySelector('#tbody');

      for(let i = 0; i < this.arrayAlunos.length; i++){
        if (this.arrayAlunos[i].matricula == matricula){
          this.arrayAlunos.splice(i,1);
          tbody.deleteRow(i);
        }
      }

      console.log(this.arrayAlunos)
      }
    }
    calculaMedia(nota1, nota2, nota3){
      return parseFloat(((nota1 + nota2 + nota3) / 3).toFixed(2));
    }
  }
  var aluno = new Aluno();


