package Hash;

public class Hash {

    public static void main(String[] args) {

        Hasheito hash = new Hasheito("algo", "estaeslaclave");

        String encodedString = hash.encode256();
        System.out.println(encodedString);
        String decodedString = hash.decode256(""
                + ".¶}§,ì&õ|ä5,<ö­÷-ædìnµ¼¿§¤¯%'ÿ,,í´¯¦tæµ/ý,íìt½lç4­þæl¿¼}ÿ%¦§¥õ4åö·¥~®e§|µm,¥åwõ=t%®<-6$í%=<¾¥?å¬67æg¥ÿ¤v>ýÿÿö÷-/}lüç'ü-¦7$få%¯6oeïww-ç§¯ü}7¤íggmfon­ý¿=ÿ§~­÷-o6ìþv·§ì·ä6lo®eí?&7÷uç/ïw¯þ¤ô&÷¤½§õ¦åee/þ6>´v~týölümld~ÿdf5÷ï=,´¥oö>tôå§,-î®fwä=§ï÷¼åo/¾¤¯´fî"
                + "");
        System.out.println(decodedString);

    }

}
