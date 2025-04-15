class Animal:
    def __init__(self, nome):
        self.__nome = nome
        self.__energia = 100
    
    def dormir(self):
        self.__energia = 100
        print(f"{self.__nome} dormiu e recuperou toda a energia!")
    
    @property
    def nome(self):
        return self.__nome
    
    @property
    def energia(self):
        return self.__energia
    
    def status(self):
        print(f"Nome: {self.__nome}")
        print(f"Energia: {self.__energia}")

class Cachorro(Animal):
    def __init__(self, nome, comida, sono):
        super().__init__(nome)  # Chama o construtor da classe pai
        self.__comida = comida
        self.__sono = sono
    
    def latir(self):
        if self.energia > 0:
            print("Au au!")
            self._Animal__energia -= 10  # Reduz a energia ao latir
        else:
            print(f"{self.nome} está sem energia para latir!")
    
    def comer(self):
        if self.__comida > 0:
            self.__comida -= 1
            self._Animal__energia += 20  # Aumenta a energia ao comer
            print(f"{self.nome} comeu e ganhou energia!")
        else:
            print(f"{self.nome} está sem comida!")
    
    def status(self):
        super().status()  # Chama o método status da classe pai
        print(f"Comida: {self.__comida}")
        print(f"Sono: {self.__sono}")

class CachorroGuarda(Cachorro):
    def __init__(self, nome, comida, sono, area_patrulha):
        super().__init__(nome, comida, sono)
        self.__area_patrulha = area_patrulha
    
    def patrulhar(self):
        if self.energia > 0:
            print(f"Patrulhando a área {self.__area_patrulha}")
            self._Animal__energia -= 30  # Reduz a energia ao patrulhar
        else:
            print(f"{self.nome} está sem energia para patrulhar!")
    
    def status(self):
        super().status()  # Chama o método status da classe Cachorro
        print(f"Área de patrulha: {self.__area_patrulha}")

# Exemplo de uso
if __name__ == "__main__":
    # Cria um cachorro de guarda
    cachorro_guarda = CachorroGuarda(nome="Thor", comida=3, sono=5, area_patrulha="Quintal")
    
    # Mostra o status inicial
    print("Status inicial:")
    cachorro_guarda.status()
    
    # Interação com o cachorro de guarda
    print("\nInteragindo com o cachorro de guarda:")
    cachorro_guarda.latir()
    cachorro_guarda.comer()
    cachorro_guarda.patrulhar()
    cachorro_guarda.latir()
    cachorro_guarda.dormir()
    cachorro_guarda.patrulhar()
    
    # Mostra o status final
    print("\nStatus final:")
    cachorro_guarda.status()