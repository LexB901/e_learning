using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Text.RegularExpressions;


namespace TafelTester
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    /// 
    public static class GLOBALS
    {
        public static int score { get; set; }
        
    }
    public partial class MainWindow : Window
    {

        public MainWindow()
        {
            InitializeComponent();

        }
        private new void PreviewTextInput(object sender, TextCompositionEventArgs e)
        {
            Regex regex = new Regex("[^0-9]+");
            e.Handled = regex.IsMatch(e.Text);
        }

        public bool IsDefault { get; set; }

        private void ButtonBack_Click(object sender, RoutedEventArgs e)
        {
            ButtonBack.Visibility = Visibility.Collapsed;
            ButtonEasy.Visibility = Visibility.Visible;
            ButtonNormal.Visibility = Visibility.Visible;
            ButtonHard.Visibility = Visibility.Visible;
            QuestionEasyGrid.Visibility = Visibility.Collapsed;
            QuestionNormalGrid.Visibility = Visibility.Collapsed;
            QuestionHardGrid.Visibility = Visibility.Collapsed;
            AnsEasyCorrect.Visibility = Visibility.Collapsed;
            AnsEasyWrong.Visibility = Visibility.Collapsed;
            AnsNormalCorrect.Visibility = Visibility.Collapsed;
            AnsNormalWrong.Visibility = Visibility.Collapsed;
            AnsHardCorrect.Visibility = Visibility.Collapsed;
            AnsHardWrong.Visibility = Visibility.Collapsed;
            EasyScore.Text = "Score: 0";
            NormalScore.Text = "Score: 0";
            HardScore.Text = "Score: 0";
            GLOBALS.score = 0;
        }

        private void EasyQuestionGrid(object sender, RoutedEventArgs e)
        {
            ButtonEasy.Visibility = Visibility.Collapsed;
            ButtonNormal.Visibility = Visibility.Collapsed;
            ButtonHard.Visibility = Visibility.Collapsed;
            ButtonBack.Visibility = Visibility.Visible;
            QuestionEasyGrid.Visibility = Visibility.Visible;
            Random rnd = new Random();
            EasyNum1.Text = rnd.Next(0, 11).ToString();
            EasyNum2.Text = rnd.Next(0, 11).ToString();
        }

        private void NormalQuestionGrid(object sender, RoutedEventArgs e)
        {
            ButtonEasy.Visibility = Visibility.Collapsed;
            ButtonNormal.Visibility = Visibility.Collapsed;
            ButtonHard.Visibility = Visibility.Collapsed;
            ButtonBack.Visibility = Visibility.Visible;
            QuestionNormalGrid.Visibility = Visibility.Visible;
            Random rnd = new Random();
            NormalNum1.Text = rnd.Next(10, 21).ToString();
            NormalNum2.Text = rnd.Next(0, 11).ToString();
        }

        private void HardQuestionGrid(object sender, RoutedEventArgs e)
        {
            ButtonEasy.Visibility = Visibility.Collapsed;
            ButtonNormal.Visibility = Visibility.Collapsed;
            ButtonHard.Visibility = Visibility.Collapsed;
            ButtonBack.Visibility = Visibility.Visible;
            QuestionHardGrid.Visibility = Visibility.Visible;
            Random rnd = new Random();
            HardNum1.Text = rnd.Next(10, 21).ToString();
            HardNum2.Text = rnd.Next(0, 11).ToString();
        }

        private void EasyQuestion(object sender, RoutedEventArgs e)
        {
            AnsEasyCorrect.Visibility = Visibility.Collapsed;
            AnsEasyWrong.Visibility = Visibility.Collapsed;
            QuestionEasyGrid.Visibility = Visibility.Visible;
            if (String.IsNullOrEmpty(EasyInput.Text))
            {
                AnsEasyEmpty.Content = "Textbox is empty!";
                AnsEasyEmpty.Visibility = Visibility.Visible;
            }
            else if (int.Parse(EasyNum1.Text) + int.Parse(EasyNum2.Text) == int.Parse(EasyInput.Text))
            {
                AnsEasyEmpty.Visibility = Visibility.Collapsed;
                AnsEasyCorrect.Visibility = Visibility.Visible;
                GLOBALS.score += 1;
                EasyScore.Text = "Score: " + GLOBALS.score;
                EasyInput.Text = "";
                Random rnd = new Random();
                EasyNum1.Text = rnd.Next(0, 11).ToString();
                EasyNum2.Text = rnd.Next(0, 11).ToString();
            }
            else
            {
                AnsEasyEmpty.Visibility = Visibility.Collapsed;
                AnsEasyWrong.Visibility = Visibility.Visible;
                GLOBALS.score += 0;
                EasyScore.Text = "Score: " + GLOBALS.score;
                EasyInput.Text = "";
                Random rnd = new Random();
                EasyNum1.Text = rnd.Next(0, 11).ToString();
                EasyNum2.Text = rnd.Next(0, 11).ToString();
            }
        }
        private void NormalQuestion(object sender, RoutedEventArgs e)
        {
            AnsNormalCorrect.Visibility = Visibility.Collapsed;
            AnsNormalWrong.Visibility = Visibility.Collapsed;
            QuestionNormalGrid.Visibility = Visibility.Visible;


            if (String.IsNullOrEmpty(NormalInput.Text))
            {
                AnsNormalEmpty.Content = "Textbox is empty!";
                AnsNormalEmpty.Visibility = Visibility.Visible;
            }
            else if (int.Parse(NormalNum1.Text) - int.Parse(NormalNum2.Text) == int.Parse(NormalInput.Text))
            {
                AnsNormalEmpty.Visibility = Visibility.Collapsed;
                AnsNormalCorrect.Visibility = Visibility.Visible;
                GLOBALS.score += 1;
                NormalScore.Text = "Score: " + GLOBALS.score;
                NormalInput.Text = "";
                Random rnd = new Random();
                NormalNum1.Text = rnd.Next(10, 21).ToString();
                NormalNum2.Text = rnd.Next(0, 11).ToString();
            }
            else
            {
                AnsNormalEmpty.Visibility = Visibility.Collapsed;
                AnsNormalWrong.Visibility = Visibility.Visible;
                GLOBALS.score += 0;
                NormalScore.Text = "Score: " + GLOBALS.score;
                NormalInput.Text = "";
                Random rnd = new Random();
                NormalNum1.Text = rnd.Next(10, 21).ToString();
                NormalNum2.Text = rnd.Next(0, 11).ToString();
            }

        }
        private void HardQuestion(object sender, RoutedEventArgs e)
        {
            AnsHardCorrect.Visibility = Visibility.Collapsed;
            AnsHardWrong.Visibility = Visibility.Collapsed;
            QuestionHardGrid.Visibility = Visibility.Visible;

            if (String.IsNullOrEmpty(HardInput.Text))
            {
                AnsHardEmpty.Content = "Textbox is empty!";
                AnsHardEmpty.Visibility = Visibility.Visible;
            }
            else if (int.Parse(HardNum1.Text) * int.Parse(HardNum2.Text) == int.Parse(HardInput.Text))
            {
                AnsHardEmpty.Visibility = Visibility.Collapsed;
                AnsHardCorrect.Visibility = Visibility.Visible;
                GLOBALS.score += 1;
                HardScore.Text = "Score: " + GLOBALS.score;
                HardInput.Text = "";
                Random rnd = new Random();
                HardNum1.Text = rnd.Next(10, 21).ToString();
                HardNum2.Text = rnd.Next(0, 11).ToString();
            }
            else
            {
                AnsHardEmpty.Visibility = Visibility.Collapsed;
                AnsHardWrong.Visibility = Visibility.Visible;
                GLOBALS.score += 0;
                HardScore.Text = "Score: " + GLOBALS.score;
                HardInput.Text = "";
                Random rnd = new Random();
                HardNum1.Text = rnd.Next(10, 21).ToString();
                HardNum2.Text = rnd.Next(0, 11).ToString();
            }

        }
    }
}
