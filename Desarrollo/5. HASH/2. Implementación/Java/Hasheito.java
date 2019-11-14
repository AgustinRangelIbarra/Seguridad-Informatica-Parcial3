package Hash;

public class Hasheito {

    private String word;
    private char key[];
    private char lettersArray[];
    private int wordSize;
    private int encryptType;
    private int xorAndOrTimes;
    private String encoded;
    private String decoded;

    public Hasheito(String word, String key) {

        this.word = word;
        this.key = key.substring(0, 4).toCharArray();
        this.lettersArray = word.toCharArray();
        this.wordSize = word.length();
        this.encryptType = this.randomNumber(0, 1);
        this.xorAndOrTimes = this.randomNumber(0, 9);

    }

    public String encode256() {
        String encoded = "";

        if (this.wordSize > 60 || this.wordSize == 0) {
            return this.wordSize + " Is UNENCODEABLE";
        }
        for (int i = 0; i < this.wordSize; i++) {
            String tmp = this.turn4Byte(this.lettersArray[i]);
            encoded = encoded.concat(tmp);
        }
        encoded = this.fill256(encoded, 60 - this.wordSize);
        encoded = this.configByte(encoded);
        return encoded;
    }

    public String decode256(String encoded) {

        String decoded = "";
        if (this.wordSize > 60 || this.wordSize == 0) {
            return this.wordSize + " is UNDECODEABLE";
        }

        int dataNumber = this.getDataNumberConfigByte(encoded);
        decoded = this.turn4Letter(encoded, dataNumber);
        return decoded;
    }

    private String turn4Byte(char letter) {

        String word = "";
        String tmp = Integer.toBinaryString(letter);
        String tmpBinaryLetter = "";

        for (int i = 0; i < 8 - tmp.length(); i++) {

            tmpBinaryLetter = tmpBinaryLetter.concat("0");
        }
        String binaryLetter = tmpBinaryLetter.concat(tmp);
        char binaryWordArray[] = binaryLetter.toCharArray();

        for (int i = 0; i < 4; i++) {
            String createByte = this.newByte();
            String part1 = Character.toString(binaryWordArray[i * 2]);
            String part2 = createByte.substring(1, 4);
            String part3 = Character.toString(binaryWordArray[i * 2 + 1]);
            String part4 = createByte.substring(5, 8);

            String tmp2 = part1.concat(part2).concat(part3).concat(part4);
            int newCharacter = Integer.parseInt(tmp2, 2);
            word = word.concat(Character.toString((char) newCharacter));
        }

        return word;
    }

    private String fill256(String text, int lack) {
        for (int i = 0; i < lack * 4; i++) {
            String createByte = this.newByte();
            int newCaracter = Integer.parseInt(createByte, 2);
            text = text.concat(Character.toString((char) (newCaracter)));
        }
        return text;
    }

    private String configByte(String encoded) {

        String encodedConfig = "";
        // HASH -> PATITO COLOR DE CAFE
        // this.wordSize = 4 -> "4"
        // this.wordSize = 20 -> "20"
        String wordSizeString = Integer.toString(this.wordSize);
        for (int i = 0; i < wordSizeString.length(); i++) {
            encodedConfig = encodedConfig.concat(this.turn4Byte(wordSizeString.charAt(i)));
        }

        encodedConfig = this.fill256(encodedConfig, 2 - wordSizeString.length());
        // this.encryptType = 0 -> "0" -> '0'
        encodedConfig = encodedConfig.concat(this.turn4Byte(Integer.toString(this.encryptType).charAt(0)));
        encodedConfig = encodedConfig.concat(this.turn4Byte(Integer.toString(this.xorAndOrTimes).charAt(0)));
        return encoded.substring(0, 120).concat(encodedConfig).concat(encoded.substring(120, 240));

    }

    private int getDataNumberConfigByte(String decoded) {

        // confData = ['1', 'a', '1', '1', '1', '1', '1', '1' ]
        char[] confData = decoded.substring(120, 128).toCharArray();
        String acumByte = "";
        String dataSize = "";

        for (int i = 0; i < confData.length; i++) {
            String binaryLetter = Integer.toBinaryString(confData[i]);
            String tmpBinaryLetter = "";
            for (int j = 0; j < 8 - binaryLetter.length(); j++) {
                tmpBinaryLetter = tmpBinaryLetter.concat("0");
            }
            binaryLetter = tmpBinaryLetter.concat(binaryLetter);
            acumByte = acumByte.concat(binaryLetter.substring(0, 1)).concat(binaryLetter.substring(4, 5));
            if (i == 3 || i == 7) {
                dataSize = dataSize.concat(Character.toString((char) Integer.parseInt(acumByte, 2)));
                acumByte = "";
            }
        }
        // dataSize = 019201918201 - 9{P9
        return dataSize.matches("[0-9]+") ? Integer.parseInt(dataSize) : Integer.parseInt(dataSize.substring(0, 1));

    }

    private String turn4Letter(String encoded, int dataNumber) {

        char[] encodedCharArray = encoded.substring(0, 120).concat(encoded.substring(136, 256)).toCharArray();
        String decoded = "";

        for (int i = 0; i < dataNumber; i++) {
            String bits = ""
                    .concat(this.getBits(encodedCharArray[(i * 4)]))
                    .concat(this.getBits(encodedCharArray[(i * 4) + 1]))
                    .concat(this.getBits(encodedCharArray[(i * 4) + 2]))
                    .concat(this.getBits(encodedCharArray[(i * 4) + 3]));

            int newCharacter = Integer.parseInt(bits, 2);
            decoded = decoded.concat(Character.toString((char) newCharacter));
        }

        return decoded;
    }

    private String getBits(char letter) {
        String binaryLetter = Integer.toBinaryString(letter);
        String tmpBinaryLetter = "";
        for (int j = 0; j < 8 - binaryLetter.length(); j++) {
            tmpBinaryLetter = tmpBinaryLetter.concat("0");
        }
        binaryLetter = tmpBinaryLetter.concat(binaryLetter);
        return binaryLetter.substring(0, 1).concat(binaryLetter.substring(4, 5));
    }

    public String newByte() {

        String subString1 = "";
        String subString2 = "";
        String subString3 = "";

        for (int i = 0; i < 2; i++) {
            subString1 = subString1.concat(Integer.toString(this.randomNumber(0, 1)));
            subString2 = subString2.concat(Integer.toString(this.randomNumber(0, 1)));
            subString3 = subString3.concat(Integer.toString(this.randomNumber(0, 1)));

        }

        return "".concat(subString1).concat("1").concat(subString2).concat("1").concat(subString3);

    }

    private int randomNumber(int min, int max) {
        return (int) (Math.random() * ((max - min) + 1)) + min;
    }
}
