# WEA Maturitní otázka

## Otázka 26 – Školní rozvrh hodin


Pracujete na localhostu, veškeré soubory s kódy i obrázky, i sql soubor s příkazy (pokud využíváte)
uložte do jednoho adresáře. **Po skončení práce tuto složku zkopírujte na plochu, složka bude mít
vaše příjmení jako název!**

## Popis

Vytvořte kompletní webovou stránku. Všechny stránky budou mít stejnou strukturu – hlavička, tělo,
patička, menu (rozložení je na vás). Je vyžadována grafická úprava webu (máte k dispozici Inkscape).
Komponenty aplikace

## Přihlášení a registrace

Při registraci zadává uživatel pole Heslo, Kontrola hesla, Email. Všechna pole jsou povinná. Nelze
provést registraci bez vyplněných polí. Email musí být v databázi unikátní. Validace probíhá na klientu
před odesláním na server.
Přihlášení probíhá pomocí emailu a hesla. Po přihlášení bude uživatel přesměrován na hlavní stránku.
Bez přihlášení uživatel neuvidí nic (pouze informaci o tom, že se má přihlásit/registrovat)

## Zobrazení rozvrhu

Na stránce zobrazení rozvrhu se zobrazí rozvrh na aktuální den. Právě probíhající hodina bude
zvýrazněná. Pro každou hodinu se zobrazí zkratka předmětu, zkratka učitele, učebna. Nemusíte tvořit
tabulky pro učitele, předměty ani učebny, všechna data jsou zadána do textových vstupních polí při
vyváření rozvrhu. Pokud uživatel najede myší na zkratku předmětu, zobrazí se mu celý název. To
samé platí pro jméno učitele.

## Tvorba rozvrhu

Před tvorbou rozvrhu si nejdříve definujte v databázi časy vyučovacích hodin (0.-10. – nemusí se
shodovat s realitou). Následně bude zobrazen formulář, kde si uživatel zvolí v selectu den a vyučovací
hodinu (pořadí hodiny, nikoliv přesný čas). Další vstupní pole do formuláře jsou:

- Zkratka předmětu
- Název předmětu
- Zkratka vyučujícího
- Celé jméno vyučujícího
- Učebna