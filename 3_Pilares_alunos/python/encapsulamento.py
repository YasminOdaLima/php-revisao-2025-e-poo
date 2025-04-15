class Cachorro:
    def __init__(self, nome, comida, sono):
        # Atributos privados (encapsulados)
        self.__nome = nome
        self.__comida = comida
        self.__sono = sono
    
    # Getters e Setters controlam o acesso
    @property
    def nome(self):
        return self.__nome
    
    @property
    def comida(self):
        return self.__comida
    
    @comida.setter
    def comida(self, valor):
        if valor >= 0:  # Validação
            self.__comida = valor
    
    def comer(self):
        if self.__comida > 0:
            self.__comida -= 1
            print(f"{self.__nome} comeu!")
        else:
            print(f"{self.__nome} está sem comida!")
    
    def status(self):
        print(f"Nome: {self.__nome}")
        print(f"Comida: {self.__comida}")
        print(f"Sono: {self.__sono}")

# Exemplo de uso
if __name__ == "__main__":
    # Cria um cachorro
    cachorro = Cachorro(nome="Rex", comida=3, sono=5)
    
    # Mostra o status inicial
    print("Status inicial:")
    cachorro.status()
    
    # Interação com o cachorro
    print("\nInteragindo com o cachorro:")
    cachorro.comer()
    cachorro.comer()
    cachorro.comer()
    cachorro.comer()  # Tentativa de comer sem comida
    
    # Mostra o status final
    print("\nStatus final:")
    cachorro.status()