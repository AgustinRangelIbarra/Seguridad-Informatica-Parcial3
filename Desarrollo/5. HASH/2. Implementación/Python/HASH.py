from random import randint


class HASH:

    def __init__(self, word='', key=''):
        self.word = word
        self.key = list(key[0:4])
        self.lettersArray = list(word)
        self.wordSize = len(word)
        self.encryptType = randint(0, 1)
        self.xorAndOrTimes = randint(0, 9)
        self.encoded = ''
        self.decoded = ''

    def newByte(self):
        return ''.join(str(randint(0, 1)) for i in range(0, 2)) + '1' + \
               ''.join(str(randint(0, 1)) for i in range(0, 2)) + '1' + \
               ''.join(str(randint(0, 1)) for i in range(0, 2))

    def fill256(self, encoded, lack):
        for i in range(0, lack * 4):
            createByte = self.newByte()
            newCaracter = int(createByte, 2)
            encoded += chr(newCaracter)
        return encoded

    def turn4Byte(self, letter):
        word = ''
        binaryLetter = ''.join(format(ord(i), 'b') for i in letter)
        fillBinaryLetter = ''.join('0' for i in range(0, 8 - len(binaryLetter)))
        binaryLetter = fillBinaryLetter + binaryLetter
        binaryWordArray = list(binaryLetter)
        for i in range(0, 4):
            createByte = self.newByte()
            createByte = ''.join((binaryWordArray[i * 2], createByte[1:4],
                                  binaryWordArray[i * 2 + 1], createByte[5:8]))
            newCaracter = int(createByte, 2)
            word += chr(newCaracter)

        return word

    def configByte(self, encoded):
        encodedConfig = ''
        sizeArray = list(str(self.wordSize))
        for i in range(0, len(str(self.wordSize))):
            encodedConfig += self.turn4Byte(sizeArray[i])
        encodedConfig = self.fill256(encodedConfig, 2 - len(str(self.wordSize)))
        encodedConfig += self.turn4Byte(str(self.encryptType))
        encodedConfig += self.turn4Byte(str(self.xorAndOrTimes))
        return ''.join((encoded[0:120], encodedConfig, encoded[120:240]))

    def encode256(self):
        encoded = ''
        if self.wordSize > 60 or self.wordSize == 0:
            return str(self.wordSize) + ' is UNENCODEABLE'
        else:
            for i in range(0, self.wordSize):
                encoded += self.turn4Byte(self.lettersArray[i])
            encoded = self.fill256(encoded, 60 - self.wordSize)
            encoded = self.configByte(encoded)
            return encoded

    def getDataNumberConfigByte(self, encoded):
        confData = list(''.join((encoded[120:128])))
        acumByte = ''
        dataSize = ''
        for i in range(0, len(confData)):
            binaryLetter = ''.join(format(ord(i), 'b') for i in confData[i])
            fillBinaryLetter = ''.join('0' for i in range(0, 8 - len(binaryLetter)))
            binaryLetter = fillBinaryLetter + binaryLetter
            acumByte += binaryLetter[0:1] + binaryLetter[4:5]
            if i == 3 or i == 7:
                dataSize += chr(int(acumByte, 2))
                acumByte = ''

        if dataSize.isdigit():
            return int(dataSize)
        else:
            return int(list(dataSize)[0])

    def getBits(self, letter):
        binaryLetter = ''.join(format(ord(i), 'b') for i in letter)
        fillBinaryLetter = ''.join('0' for i in range(0, 8 - len(binaryLetter)))
        binaryLetter = fillBinaryLetter + binaryLetter
        return binaryLetter[0:1] + binaryLetter[4:5]

    def turn4Letter(self, encoded, dataNumber):
        encoded = list(''.join((encoded[0:120], encoded[136:256])))
        decoded = ''
        for i in range(0, dataNumber):
            bits = ''
            bits += self.getBits(encoded[(i * 4)])
            bits += self.getBits(encoded[(i * 4) + 1])
            bits += self.getBits(encoded[(i * 4) + 2])
            bits += self.getBits(encoded[(i * 4) + 3])
            decoded += chr(int(bits, 2))
        return decoded

    def decode256(self, encoded):
        if len(encoded) > 256 or len(encoded) < 256 or len(encoded) == 0:
            return str(len(encoded)) + ' is UNDECODEABLE'
        else:
            dataNumber = self.getDataNumberConfigByte(encoded)
            decodedWord = self.turn4Letter(encoded, dataNumber)
            return decodedWord


# def main():
    # Create a new HASH object
    # hasheo = HASH('HASH', 'francosmp')
    # encodeada = hasheo.encode256()
    # print(encodeada)
    # decodeada = hasheo.decode256('''m¶å'l¦®þ~´î&|ö'?¿mý½'üåö´m®u66­ÿ5$õ­ý,mfö%?ö¶}m|¿ìµä.'e?ÿ¯½-o÷/&<ôe6<>ý7·ggívo¥ýµä$õ-f¼¬nô}>ôö&||ì¿¤÷ç,¼¼·ýætn½dn=­7}¥þ5tÿ=fow·¼f½'/%½õmwmldä¤$7¦}oüvü&í|ü5¥õþ7tçüe¤o%ä=76í6tvõ&f|f¦¾5í6¯%.®¼¥?>l}õ~·lv=þ6~·¬l<gn´ín¾v-6ÿ=çuþ.ÿt¿½¶öõÿýü}ïm6¬ìe-å4æï÷®v4}ìÿï<''')
    # print(decodeada)


# main()
